<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Youtube;
use App\Models\YoutubeHistory;
use Illuminate\Http\Request;

class YoutubeHistoryController extends Controller
{
    public function index(Request $request, $child, $channel)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return YoutubeHistory::where('channel', 'LIKE', '%/' . $channel)->where('user', $child)
            ->orWhere('channel', $channel)->where('user', $child)
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel' => 'required|string',
            'user' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y H:i',
        ],
            [
                'channel.required' => 'Параметр channel обязателен',
                'channel.string' => 'Параметр channel должен быть строкой',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
                'date.required' => 'Параметр date обязателен',
                'date.date' => 'Параметр date должен быть датой',
                'date.date_format' => 'Параметр date не соответствует формату dd.MM.yyyy hh:mm',
            ]);
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedYoutube = Youtube::where('channel', 'LIKE', '%/' . $request->channel)->where("user", $request->user)
            ->orWhere('channel', $request->channel)->where("user", $request->user)
            ->first();
        if (!$existedYoutube) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['package' => 'Youtube канала ' . $request->channel . ' не существует в списке youtube каналов указанного ребенка'],
            ], 400);
        }
        $youtubeHistory = YoutubeHistory::create([
            'channel' => $existedYoutube->channel,
            'locked' => $existedYoutube->locked,
            'user' => $request->user,
            'date' => $request->date,
        ]);
        return response()->json([
            'message' => 'История посещения youtube канала добавлена',
            'data' => YoutubeHistory::find($youtubeHistory->id),
        ], 201);
    }

    public function show(Request $request, $child, $channel, $date)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return YoutubeHistory::where('user', $child)->where('date', 'LIKE', $date . '%')->where('channel', 'LIKE', '%/' . $channel)
            ->orWhere('channel', $channel)->where('date', 'LIKE', $date . '%')->where('user', $child)
            ->get();
    }

    public function destroy(Request $request, $youtube)
    {
        $existedYoutubeHistory = YoutubeHistory::where('id', $youtube)->first();
        if (!$existedYoutubeHistory) {
            return response()->json(['message' => 'Не удалось найти youtube канал с указанным id'], 404);
        }
        if (!Child::where('id', $existedYoutubeHistory->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Этот сайт не принадлежит вашему ребенку'], 403);
        }
        $existedYoutubeHistory->delete();
        return response()->json(['message' => 'История посещения youtube канала была удалена'], 200);
    }
}
