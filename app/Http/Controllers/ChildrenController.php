<?php

namespace App\Http\Controllers;

use App\Models\ActiveSubscription;
use App\Models\Child;
use App\Models\Subscription;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChildrenController extends Controller
{
    public function getDevices()
    {
        $activeSubscriptions = ActiveSubscription::whereUser(auth()->user()->id)->get()->toArray();
        $activeSubscriptions = array_filter($activeSubscriptions, function ($subscription) {
            return Carbon::createFromFormat('d.m.Y H:i', $subscription['end_dt'])->gt(Carbon::now());
        });
        $maxNumOfChildren = 0;
        foreach ($activeSubscriptions as $i => $subscription) {
            $device = Subscription::whereName($subscription['name'])->first()->device;
            if ($device > $maxNumOfChildren) {
                $maxNumOfChildren = $device;
            }
        }
        return $maxNumOfChildren;
    }

    public function index()
    {
        return Child::whereParent(auth()->user()->id)->limit($this->getDevices())->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y',
        ],
            [
                'name.required' => 'Укажите имя ребенка',
                'date.required' => 'Укажите день рождения ребенка',
            ]);
        $devices = $this->getDevices();
        if (count(Child::whereParent(auth()->user()->id)->get()->toArray()) >= $devices) {
            return response()->json(['message' => 'Вам можно подключить не более ' . $devices . ' устройств'], 403);
        }
        $child = Child::create([
            'name' => $request->name,
            'date' => $request->date,
            'parent' => auth()->user()->id,
        ]);
        return response()->json([
            'message' => 'Ребенок добавлен',
            'data' => Child::find($child->id),
        ], 201);
    }

    public function show(Request $request, $child)
    {
        return Child::whereId($child)->whereParent(auth()->user()->id)->first();
    }

    public function update(Request $request, $child)
    {
        $existedChild = Child::whereId($child)->whereParent(auth()->user()->id)->first();
        if ($request->name) {
            $request->validate(['name' => 'string']);
            $existedChild->name = $request->name;
        }
        if ($request->date) {
            $request->validate(['date' => 'date|date_format:d.m.Y']);
            $existedChild->date = $request->date;
        }
        if ($request->has('block_all_apps')) {
            $request->validate(['block_all_apps' => 'boolean']);
            $existedChild->block_all_apps = $request->block_all_apps;
        }
        if ($request->has('block_all_phones')) {
            $request->validate(['block_all_phones' => 'boolean']);
            $existedChild->block_all_phones = $request->block_all_phones;
        }
        if ($request->has('block_all_site')) {
            $request->validate(['block_all_site' => 'boolean']);
            $existedChild->block_all_site = $request->block_all_site;
        }
        if ($request->has('block_all_youtube')) {
            $request->validate(['block_all_youtube' => 'boolean']);
            $existedChild->block_all_youtube = $request->block_all_youtube;
        }
        $existedChild->update();
        return response()->json([
            'message' => 'Данные ребенка обновлены',
            'data' => $existedChild,
        ], 202);
    }

    public function destroy(Request $request, $child)
    {
        $existedChild = Child::whereId($child)->whereParent(auth()->user()->id)->first();
        $existedChild->delete();
        return response()->json(['message' => 'Ребенок удален'], 200);
    }
}
