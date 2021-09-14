<?php

namespace App\Http\Controllers;

use App\Models\Site;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function index(Request $request)
    {
        return Site::whereParent(auth()->user()->id)->whereChild($request->header('child'))->get()->pluck('site');
    }

    public function store(Request $request)
    {
        $request->validate([
            'site' => 'required|string',
            'child' => 'required|string',
        ]);
        if (!preg_match('/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i', $request->site)) {
            $request->validate(['site' => 'ip'], ['site.ip' => 'Параметр site должен быть валидным хостом или IP-адресом']);
        }
        if (Site::whereSite($request->site)->whereChild($request->child)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['site' => 'Этот сайт уже заблокирован для указанного ребенка'],
            ], 404);
        }
        $site = Site::create([
            'site' => $request->site,
            'child' => $request->child,
            'parent' => auth()->user()->id,
        ]);
        return response()->json('Сайт заблокирован', 200);
    }

    public function destroy(Request $request)
    {
        $existedSite = Site::whereSite($request->header('site'))->whereChild($request->header('child'))->first();
        if (!$existedSite) {
            return response()->json('Не удалось найти сайт', 404);
        }
        $existedSite->delete();
        return response()->json('Сайт разблокирован', 200);
    }
}
