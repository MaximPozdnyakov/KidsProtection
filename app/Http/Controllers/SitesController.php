<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Site;
use App\Models\SiteHistory;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function index(Request $request, $child)
    {
        return Site::whereParent(auth()->user()->id)->whereUser($child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'locked' => 'boolean',
            'user' => 'required|string',
            'start_dt' => 'date|date_format:d.m.Y H:i',
            'end_dt' => 'date|date_format:d.m.Y H:i',
        ]);
        if (!preg_match('/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i', $request->host)) {
            $request->validate(['host' => 'ip'], ['host.ip' => 'Параметр host должен быть валидным хостом или IP-адресом']);
        }
        if (!Child::whereId($request->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        if (Site::whereHost($request->host)->whereUser($request->user)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['host' => 'Этот сайт уже добавлен в список сайтов указанного ребенка'],
            ], 400);
        }
        $site = Site::create([
            'host' => $request->host,
            'parent' => auth()->user()->id,
            'user' => $request->user,
            'locked' => $request->get('locked', 1),
            'start_dt' => $request->get('start_dt', null),
            'end_dt' => $request->get('end_dt', null),
        ]);
        return response()->json([
            'message' => 'Сайт добавлен',
            'data' => Site::find($site->id),
        ], 201);
    }

    public function show(Request $request, $child, $site)
    {
        if (!Child::whereId($child)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return Site::whereId($site)->whereUser($child)->first();
    }

    public function update(Request $request, $site)
    {
        $existedSite = Site::whereId($site)->whereParent(auth()->user()->id)->first();
        if (!$existedSite) {
            return response()->json(['message' => 'Не удалось найти приложение с указанным id'], 404);
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean']);
            $existedSite->locked = $request->locked;
            SiteHistory::whereHost($existedSite->host)->whereUser($existedSite->user)
                ->update(['locked' => $request->locked]);
        }
        if ($request->has('start_dt')) {
            if (!is_null($request->start_dt)) {
                $request->validate(['start_dt' => 'date|date_format:d.m.Y H:i']);
            }
            $existedSite->start_dt = $request->start_dt;
        }
        if ($request->has('end_dt')) {
            if (!is_null($request->end_dt)) {
                $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i']);
            }
            $existedSite->end_dt = $request->end_dt;
        }
        $existedSite->update();
        return response()->json([
            'message' => 'Настройки сайта обновлены',
            'data' => $existedSite,
        ], 202);
    }

    public function destroy(Request $request, $site)
    {
        $existedSite = Site::whereId($site)->whereParent(auth()->user()->id)->first();
        if (!$existedSite) {
            return response()->json(['message' => 'Не удалось найти сайт с указанным id'], 404);
        }
        $existedSite->delete();
        return response()->json(['message' => 'Сайт удален из списка сайтов'], 200);
    }
}
