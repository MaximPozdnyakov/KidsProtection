<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Site;
use Illuminate\Http\Request;

class SitesController extends Controller
{
    public function index(Request $request, $child)
    {
        return Site::where('parent', auth()->user()->id)->where('user', $child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'host' => 'required|string',
            'locked' => 'boolean',
            'user' => 'required|string',
            'start_dt' => 'date|date_format:d.m.Y H:i',
            'end_dt' => 'date|date_format:d.m.Y H:i',
        ],
            [
                'host.required' => 'Параметр host обязателен',
                'host.string' => 'Параметр host должен быть строкой',
                'locked.boolean' => 'Параметр locked должен быть булевым',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
                'start_dt.date' => 'Параметр start_dt должен быть датой',
                'start_dt.date_format' => 'Параметр start_dt не соответствует формату dd.MM.yyyy hh:mm',
                'end_dt.date' => 'Параметр end_dt должен быть датой',
                'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
            ]);
        if (!preg_match('/^(?!:\/\/)(?=.{1,255}$)((.{1,63}\.){1,127}(?![0-9]*$)[a-z0-9-]+\.?)$/i', $request->host)) {
            $request->validate(['host' => 'ip'], ['host.ip' => 'Параметр host должен быть валидным хостом или IP-адресом']);
        }
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        if (Site::where('host', $request->host)->where("user", $request->user)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['host' => 'Этот сайт уже добавлен в список сайтов указанного ребенка'],
            ], 400);
        }
        $site = Site::create([
            'host' => $request->host,
            'parent' => auth()->user()->id,
            'user' => $request->user,
            'locked' => $request->has('locked') ? $request->locked : 1,
            'start_dt' => $request->has('start_dt') ? $request->start_dt : null,
            'end_dt' => $request->has('end_dt') ? $request->end_dt : null,
        ]);
        $site = Site::find($site->id);
        return response()->json([
            'message' => 'Сайт добавлен',
            'data' => $site,
        ], 201);
    }

    public function show(Request $request, $child, $site)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return Site::where('id', $site)->where("user", $child)->first();
    }

    public function update(Request $request, $site)
    {
        $existedSite = Site::where('id', $site)->where("parent", auth()->user()->id)->first();
        if (!$existedSite) {
            return response()->json(['message' => 'Не удалось найти приложение с указанным id'], 404);
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean'], ['locked.boolean' => 'Параметр locked должен быть булевым значением']);
            $existedSite->locked = $request->locked;
        }
        if ($request->has('start_dt')) {
            if (!is_null($request->start_dt)) {
                $request->validate(['start_dt' => 'date|date_format:d.m.Y H:i'],
                    [
                        'start_dt.date' => 'Параметр start_dt должен быть датой',
                        'start_dt.date_format' => 'Параметр start_dt не соответствует формату dd.MM.yyyy hh:mm',
                    ]);
            }
            $existedSite->start_dt = $request->start_dt;
        }
        if ($request->has('end_dt')) {
            if (!is_null($request->end_dt)) {
                $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i'],
                    [
                        'end_dt.date' => 'Параметр end_dt должен быть датой',
                        'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
                    ]);
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
        $existedSite = Site::where('id', $site)->where("parent", auth()->user()->id)->first();
        if (!$existedSite) {
            return response()->json(['message' => 'Не удалось найти сайт с указанным id'], 404);
        }
        $existedSite->delete();
        return response()->json(['message' => 'Сайт удален из списка сайтов'], 200);
    }
}
