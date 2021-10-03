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
        return $this->jsonResponse(array_slice(
            Application::whereParent(auth()->user()->id)->whereUser($request->header('child'))
                ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user'])->toArray()
            , $indexFrom, 20));
    }

    public function getBlocked(Request $request)
    {
        return $this->jsonResponse(Application::whereUser($request->header('child'))->whereLimit(0)
                ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user']));
    }

    public function getLimited(Request $request)
    {
        $blockedApps = Application::whereUser($request->header('child'))->whereNotNull('limit')->where('limit', '!=', 0)
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
        return $this->jsonResponse($blockedApps);
    }

    public function getAll(Request $request)
    {
        return $this->jsonResponse(Application::whereUser($request->header('child'))
                ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user']));
    }

    public function block(Request $request)
    {
        $request->validate([
            'pack' => 'required|string',
            'child' => 'required|string',
        ]);
        $existedApplication = Application::wherePack($request->pack)->whereUser($request->child)->first();
        if (!$existedApplication) {
            return $this->jsonResponse('Приложение с таким названием не существует в списке приложений указанного ребенка', 404);
        }
        $existedApplication->limit = 0;
        $existedApplication->update();
        return $this->jsonResponse("Приложение заблокировано", 200);
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
                return $this->jsonResponse('Приложение ' . $pack . ' не существует в списке приложений указанного ребенка', 404);
            }
            $existedApplication->update(['limit' => 0]);
        }
        return $this->jsonResponse("Приложения заблокированы", 200);
    }

    public function unblock(Request $request)
    {
        $existedApplication = Application::whereId($request->header('app'))->whereUser($request->header('child'))->first();
        if (!$existedApplication) {
            return $this->jsonResponse('Не удалось найти приложение', 404);
        }
        $existedApplication->limit = null;
        $existedApplication->update();
        return $this->jsonResponse('Приложение разблокировано', 200);
    }

    public function sync(Request $request)
    {
        $request->validate([
            '*.pack' => 'required|string',
            '*.name' => 'string',
            '*.icon' => 'string',
        ]);
        $newApps = $request->all();
        foreach ($newApps as $newApp) {
            $currentApp = Application::whereUser($request->header('child'))
                ->wherePack($newApp['pack'])->first();
            if ($currentApp) {
                if (array_key_exists('name', $newApp)) {
                    $currentApp->update(['name' => $newApp['name']]);
                }
                if (array_key_exists('icon', $newApp)) {
                    $path = '/icons/uploads/' . $currentApp->name . '-' . time() . '.png';
                    file_put_contents(public_path() . $path, base64_decode($newApp['icon']));
                    $currentApp->update(['icon' => url($path)]);
                }
            } else {
                $path = '/icons/uploads/' . $newApp['name'] . '-' . time() . '.png';
                file_put_contents(public_path() . $path, base64_decode($newApp['icon']));
                Application::create([
                    'pack' => $newApp['pack'],
                    'name' => $newApp['name'],
                    'icon' => url($path),
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
        return $this->jsonResponse('Приложения синхронизированы', 200);
    }

    public function limit(Request $request)
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
            return $this->jsonResponse('Приложение с таким названием не существует в списке приложений указанного ребенка', 404);
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
        return $this->jsonResponse("Приложение ограничено", 200);
    }

    public function limitMany(Request $request)
    {
        $request->validate([
            'packs.*' => 'required|string',
            'limit' => 'integer|nullable',
            'from' => 'string|nullable',
            'to' => 'string|nullable',
            'child' => 'required|string',
        ]);
        foreach ($request->packs as $pack) {
            $existedApplication = Application::wherePack($pack)->whereUser($request->child)->first();
            if (!$existedApplication) {
                return $this->jsonResponse('Приложение с названием ' . $pack . ' не существует в списке приложений указанного ребенка', 404);
            }
            if ($request->has('limit')) {
                $existedApplication->limit = $request->limit;
            }
            if ($request->has('from')) {
                $existedApplication->from = $request->from;
            }
            if ($request->has('to')) {
                $existedApplication->to = $request->to;
            }
            $existedApplication->update();
        }
        return $this->jsonResponse("Приложения ограничены", 200);
    }

    public function unLimit(Request $request)
    {
        $existedApplication = Application::whereId($request->header('app'))->whereUser($request->header('child'))->first();
        if (!$existedApplication) {
            return $this->jsonResponse('Не удалось найти приложение', 404);
        }
        $existedApplication->limit = null;
        $existedApplication->from = null;
        $existedApplication->to = null;
        $existedApplication->update();
        return $this->jsonResponse('Ограничения сняты с приложения', 200);
    }
}
