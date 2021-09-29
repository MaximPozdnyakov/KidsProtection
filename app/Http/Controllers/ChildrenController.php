<?php

namespace App\Http\Controllers;

use App\Models\ActiveSubscription;
use App\Models\Child;
use App\Models\Device;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function getDevices()
    {
        $activeSubscriptions = ActiveSubscription::whereUser(auth()->user()->id)->get()->toArray();
        $activeSubscriptions = array_filter($activeSubscriptions, function ($subscription) {
            return Carbon::createFromFormat('d.m.Y H:i', $subscription['endDate'])->gt(Carbon::now());
        });
        $maxNumOfChildren = 0;
        foreach ($activeSubscriptions as $i => $subscription) {
            $device = Subscription::whereName($subscription['subscribe'])->first()->device;
            if ($device > $maxNumOfChildren) {
                $maxNumOfChildren = $device;
            }
        }
        return $maxNumOfChildren;
    }

    public function index()
    {
        return Child::whereParent(auth()->user()->id)->get()
            ->makeHidden(['allAppsLock', 'allAppsLimit', 'allAppsStartTime', 'allAppsFinishTime', 'parent']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'child.name' => 'required|string',
            'child.year' => 'required|integer',
        ],
            [
                'child.name.required' => 'Укажите имя ребенка',
                'child.year.required' => 'Укажите год рождения ребенка',
            ]);
        $child = Child::create([
            'name' => $request->child['name'],
            'year' => $request->child['year'],
            'parent' => auth()->user()->id,
        ]);
        return response()->json(
            Child::find($child->id)->makeHidden(['allAppsLock', 'allAppsLimit', 'allAppsStartTime', 'allAppsFinishTime', 'parent'])
            , 200);
    }

    public function show(Request $request)
    {
        $child = Child::whereId($request->header('child'))->whereParent(auth()->user()->id)->first()
            ->makeHidden('parent')->toArray();
        $child['allApps'] = [
            'allAppsLock' => $child['allAppsLock'],
            'allAppsLimit' => $child['allAppsLimit'],
            'allAppsStartTime' => $child['allAppsStartTime'],
            'allAppsFinishTime' => $child['allAppsFinishTime'],
        ];
        unset($child['allAppsLock']);
        unset($child['allAppsLimit']);
        unset($child['allAppsStartTime']);
        unset($child['allAppsFinishTime']);
        return $child;
    }

    public function update(Request $request)
    {
        $existedChild = Child::whereId($request->child['id'])->whereParent(auth()->user()->id)->first();
        if (array_key_exists('name', $request->child)) {
            $request->validate(['child.name' => 'string']);
            $existedChild->name = $request->child['name'];
        }
        if (array_key_exists('year', $request->child)) {
            $request->validate(['child.year' => 'integer']);
            $existedChild->year = $request->child['year'];
        }
        if (array_key_exists('allowedTimeOfAppsUse', $request->child)) {
            if (!is_null($request->child['allowedTimeOfAppsUse'])) {
                $request->validate(['child.allowedTimeOfAppsUse' => 'date_format:H:i']);
            }
            $existedChild->allowedTimeOfAppsUse = $request->child['allowedTimeOfAppsUse'];
        }
        $existedChild->update();
        return response()->json(
            $existedChild->makeHidden(['allAppsLock', 'allAppsLimit', 'allAppsStartTime', 'allAppsFinishTime', 'parent'])
            , 200);
    }

    public function destroy(Request $request)
    {
        $existedChild = Child::whereId($request->header('child'))->whereParent(auth()->user()->id)->first();
        $childCopy = $existedChild;
        $existedChild->delete();
        return response()->json("Ребенок удален", 200);
    }

    public function updateApps(Request $request)
    {
        $existedChild = Child::whereId($request->header('child'))->whereParent(auth()->user()->id)->first();
        if ($request->has('allAppsLock')) {
            $request->validate(['allAppsLock' => 'boolean']);
            $existedChild->allAppsLock = $request->allAppsLock;
        }
        if ($request->has('allAppsLimit')) {
            if (!is_null($request->allAppsLimit)) {
                $request->validate(['allAppsLimit' => 'integer']);
            }
            $existedChild->allAppsLimit = $request->allAppsLimit;
        }
        if ($request->has('allAppsStartTime')) {
            if (!is_null($request->allAppsStartTime)) {
                $request->validate(['allAppsStartTime' => 'string']);
            }
            $existedChild->allAppsStartTime = $request->allAppsStartTime;
        }
        if ($request->has('allAppsFinishTime')) {
            if (!is_null($request->allAppsFinishTime)) {
                $request->validate(['allAppsFinishTime' => 'string']);
            }
            $existedChild->allAppsFinishTime = $request->allAppsFinishTime;
        }
        $existedChild->update();
        return response()->json("Настройки приложений обновлены", 200);
    }

    public function showDevice(Request $request)
    {
        $device = Device::where('deviceId', $request->header('device'))->first();
        if (!$device) {
            return response()->json('Устройство не найдено', 404);
        }
        if ($device->parent != auth()->user()->id) {
            return response()->json('Устройство не принадлежит вашему ребенку', 404);
        }
        return response()->json('Устройство найдено', 200);
    }

    public function storeDevice(Request $request)
    {
        $maxNumOfDevices = $this->getDevices();
        $numOfExistedDevices = count(Device::whereParent(auth()->user()->id)->get()->toArray());
        if ($numOfExistedDevices >= $maxNumOfDevices) {
            return response()->json('Вам можно подключить не более ' . $maxNumOfDevices . ' устройств', 404);
        }
        Device::create([
            'parent' => auth()->user()->id,
            'child' => $request->header('child'),
            'deviceId' => $request->header('device'),
        ]);
        return response()->json('Устройство добавлено', 200);
    }

    public function destroyDevice(Request $request)
    {
        $device = Device::where('deviceId', $request->header('device'))->first();
        if (!$device) {
            return response()->json('Устройство не найдено', 404);
        }
        if ($device->parent != auth()->user()->id) {
            return response()->json('Устройство не принадлежит вашему ребенку', 404);
        }
        $device->delete();
        return response()->json('Устройство удалено', 200);
    }
}
