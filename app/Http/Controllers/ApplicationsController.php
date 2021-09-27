<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function getAllWithLimit(Request $request)
    {
        $appsIds = Application::whereParent(auth()->user()->id)->whereUser($request->header('child'))->get()->pluck('id')->toArray();
        $indexFrom = 0;
        if ($request->header('last') && $request->header('last') != "null") {
            $indexFrom = array_search($request->header('last'), $appsIds) + 1;
        }
        return array_slice(
            Application::whereParent(auth()->user()->id)->whereUser($request->header('child'))
                ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user'])->toArray()
            , $indexFrom, 20);
    }

    public function getBlocked(Request $request)
    {
        return Application::whereUser($request->header('child'))->whereNotNull('limit')
            ->orWhere('user', $request->header('child'))->whereNotNull('from')
            ->orWhere('user', $request->header('child'))->whereNotNull('to')
            ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user']);
    }

    public function getBlockedWithOptions(Request $request)
    {
        $blockedApps = Application::whereUser($request->header('child'))->whereNotNull('limit')
            ->orWhere('user', $request->header('child'))->whereNotNull('from')
            ->orWhere('user', $request->header('child'))->whereNotNull('to')
            ->get()->makeHidden(['parent', 'user'])->toArray();
        foreach ($blockedApps as $i => $blockedApp) {
            $blockedApps[$i]['app'] = [
                'id' => $blockedApp['id'],
                'name' => $blockedApp['name'],
                'pack' => $blockedApp['pack'],
                'icon' => $blockedApp['icon'],
            ];
            unset($blockedApps[$i]['id']);
            unset($blockedApps[$i]['name']);
            unset($blockedApps[$i]['pack']);
            unset($blockedApps[$i]['icon']);
        }
        return $blockedApps;
    }

    public function getAll(Request $request)
    {
        return Application::whereUser($request->header('child'))
            ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user']);
    }

    public function block(Request $request)
    {
        $request->validate([
            'app.pack' => 'required|string',
            'app.limit' => 'integer|nullable',
            'app.from' => 'string|nullable',
            'app.to' => 'string|nullable',
            'child' => 'required|string',
        ]);
        $existedApplication = Application::wherePack($request->app['pack'])->whereUser($request->child)->first();
        if (!$existedApplication) {
            return response()->json('Приложение с таким названием не существует в списке приложений указанного ребенка', 404);
        }
        if (array_key_exists('limit', $request->app)) {
            $existedApplication->limit = $request->app['limit'];
        }
        if (array_key_exists('from', $request->app)) {
            $existedApplication->from = $request->app['from'];
        }
        if (array_key_exists('to', $request->app)) {
            $existedApplication->to = $request->app['to'];
        }
        $existedApplication->update();
        return response()->json("Приложение заблокировано", 200);
    }

    public function blockMany(Request $request)
    {
        $request->validate([
            'packs.*' => 'required|string',
            'child' => 'required|string',
        ]);
        $packs = $request->packs;
        foreach ($packs as $pack) {
            $existedApplication = Application::wherePack($pack)->whereUser($request->child)->first();
            if (!$existedApplication) {
                return response()->json('Приложение ' . $pack . ' не существует в списке приложений указанного ребенка', 404);
            }
            $existedApplication->update(['limit' => 0]);
        }
        return response()->json("Приложения заблокированы", 200);
    }

    public function unblock(Request $request)
    {
        $existedApplication = Application::whereId($request->header('app'))->whereUser($request->header('child'))->first();
        if (!$existedApplication) {
            return response()->json('Не удалось найти приложение', 404);
        }
        $existedApplication->limit = null;
        $existedApplication->from = null;
        $existedApplication->to = null;
        $existedApplication->update();
        return response()->json('Приложение разблокировано', 200);
    }

    public function sync(Request $request)
    {
        $request->validate([
            '*.pack' => 'required|string',
            '*.name' => 'required|string',
            '*.icon' => 'required|string',
        ]);
        $newApps = $request->all();
        foreach ($newApps as $newApp) {
            $currentApp = Application::whereUser($request->header('child'))
                ->wherePack($newApp['pack'])->first();
            if ($currentApp) {
                $currentApp->update([
                    'name' => $newApp['name'],
                    'icon' => $newApp['icon'],
                ]);
            } else {
                Application::create([
                    'pack' => $newApp['pack'],
                    'name' => $newApp['name'],
                    'icon' => $newApp['icon'],
                    'parent' => auth()->user()->id,
                    'user' => $request->header('child'),
                ]);
            }
        }

        $currentApps = Application::whereUser($request->header('child'))->get()->toArray();
        foreach ($currentApps as $currentApp) {
            $newAppIndex = array_search($currentApp['pack'], array_column($newApps, 'pack'));
            if ($newAppIndex === false) {
                Application::whereUser($request->header('child'))->wherePack($currentApp['pack'])
                    ->first()->delete();
            }
        }
        return response()->json('Приложения синхронизированы', 200);
    }
}
