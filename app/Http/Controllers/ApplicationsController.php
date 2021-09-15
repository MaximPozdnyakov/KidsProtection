<?php

namespace App\Http\Controllers;

use App\Models\Application;
use Illuminate\Http\Request;

class ApplicationsController extends Controller
{
    public function index(Request $request)
    {
        $appsIds = Application::whereParent(auth()->user()->id)->whereUser($request->header('child'))->get()->pluck('id')->toArray();
        $indexFrom = 0;
        if ($request->header('last') && $request->header('last') != "null") {
            $indexFrom = array_search($request->header('last'), $appsIds) + 1;
        }
        return array_slice(
            Application::whereParent(auth()->user()->id)->whereUser($request->header('child'))
                ->get()->makeHidden(['limit', 'from', 'to', 'parent', 'user'])->toArray()
            , $indexFrom, 2);
    }

    public function show(Request $request)
    {
        return Application::whereUser($request->header('child'))->whereNotNull('limit')
            ->orWhere('user', $request->header('child'))->whereNotNull('from')
            ->orWhere('user', $request->header('child'))->whereNotNull('to')
            ->get()->makeHidden(['id', 'name', 'icon', 'parent', 'user']);
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
            return response()->json('Приложения с таким названием не существует в списке приложений указанного ребенка', 404);
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

    public function store(Request $request)
    {
        $request->validate([
            'app.pack' => 'required|string',
            'app.name' => 'required|string',
            'app.icon' => 'required|string',
            'child' => 'required|string',
        ]);
        $existedApplication = Application::wherePack($request->app['pack'])->whereUser($request->child)->first();
        if ($existedApplication) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['app.pack' => 'Приложение с таким названием уже существует в списке приложений указанного ребенка'],
            ], 404);
        }
        $application = Application::create([
            'pack' => $request->app['pack'],
            'name' => $request->app['name'],
            'icon' => $request->app['icon'],
            'parent' => auth()->user()->id,
            'user' => $request->child,
        ]);
        return response()->json(
            Application::find($application->id)->makeHidden(['limit', 'from', 'to', 'parent', 'user'])
            , 200);
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
}
