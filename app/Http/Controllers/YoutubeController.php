<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Youtube;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index(Request $request, $child)
    {
        return Youtube::where('parent', auth()->user()->id)->where('user', $child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel' => 'required|string',
            'locked' => 'boolean',
            'user' => 'required|string',
            'start_dt' => 'date|date_format:d.m.Y H:i',
            'end_dt' => 'date|date_format:d.m.Y H:i',
        ],
            [
                'channel.required' => 'Параметр channel обязателен',
                'channel.string' => 'Параметр channel должен быть строкой',
                'locked.boolean' => 'Параметр locked должен быть булевым',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
                'start_dt.date' => 'Параметр start_dt должен быть датой',
                'start_dt.date_format' => 'Параметр start_dt не соответствует формату dd.MM.yyyy hh:mm',
                'end_dt.date' => 'Параметр end_dt должен быть датой',
                'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
            ]);
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        if (Youtube::where('channel', $request->channel)->where("user", $request->user)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['channel' => 'Этот youtube канал уже добавлен в список youtube каналов указанного ребенка'],
            ], 400);
        }
        $youtube = Youtube::create([
            'channel' => $request->channel,
            'parent' => auth()->user()->id,
            'user' => $request->user,
            'locked' => $request->has('locked') ? $request->locked : 1,
            'start_dt' => $request->has('start_dt') ? $request->start_dt : null,
            'end_dt' => $request->has('end_dt') ? $request->end_dt : null,
        ]);
        return response()->json([
            'message' => 'Youtube канал добавлен',
            'data' => Youtube::find($youtube->id),
        ], 201);
    }

    public function show(Request $request, $child, $youtube)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return Youtube::where('id', $youtube)->where("user", $child)->first();
    }

    public function update(Request $request, $youtube)
    {
        $existedYoutube = Youtube::where('id', $youtube)->where("parent", auth()->user()->id)->first();
        if (!$existedYoutube) {
            return response()->json(['message' => 'Не удалось найти youtube канал с указанным id'], 404);
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean'], ['locked.boolean' => 'Параметр locked должен быть булевым значением']);
            $existedYoutube->locked = $request->locked;
            // YoutubeHistory::where('channel', $existedYoutube->channel)->where('user', $existedYoutube->user)
            //     ->update('locked', $request->locked);
        }
        if ($request->has('start_dt')) {
            if (!is_null($request->start_dt)) {
                $request->validate(['start_dt' => 'date|date_format:d.m.Y H:i'],
                    [
                        'start_dt.date' => 'Параметр start_dt должен быть датой',
                        'start_dt.date_format' => 'Параметр start_dt не соответствует формату dd.MM.yyyy hh:mm',
                    ]);
            }
            $existedYoutube->start_dt = $request->start_dt;
        }
        if ($request->has('end_dt')) {
            if (!is_null($request->end_dt)) {
                $request->validate(['end_dt' => 'date|date_format:d.m.Y H:i'],
                    [
                        'end_dt.date' => 'Параметр end_dt должен быть датой',
                        'end_dt.date_format' => 'Параметр end_dt не соответствует формату dd.MM.yyyy hh:mm',
                    ]);
            }
            $existedYoutube->end_dt = $request->end_dt;
        }
        $existedYoutube->update();
        return response()->json([
            'message' => 'Настройки youtube канала обновлены',
            'data' => $existedYoutube,
        ], 202);
    }

    public function destroy(Request $request, $youtube)
    {
        $existedYoutube = Youtube::where('id', $youtube)->where("parent", auth()->user()->id)->first();
        if (!$existedYoutube) {
            return response()->json(['message' => 'Не удалось найти youtube канал с указанным id'], 404);
        }
        $existedYoutube->delete();
        return response()->json(['message' => 'Youtube канал удален'], 200);
    }
}
