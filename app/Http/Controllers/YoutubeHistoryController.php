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
        return YoutubeHistory::where('channel', 'LIKE', '%/' . $channel)->whereUser($child)
            ->orWhere('channel', $channel)->whereUser($child)
            ->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel' => 'required|string',
            'user' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y H:i',
        ]);
        $existedYoutube = Youtube::where('channel', 'LIKE', '%/' . $request->channel)->whereUser($request->user)
            ->orWhere('channel', $request->channel)->whereUser($request->user)
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
        if (!Child::whereId($child)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return YoutubeHistory::whereUser($child)->where('date', 'LIKE', $date . '%')->where('channel', 'LIKE', '%/' . $channel)
            ->orWhere('channel', $channel)->where('date', 'LIKE', $date . '%')->whereUser($child)
            ->get();
    }

    public function destroy(Request $request, $youtube)
    {
        $existedYoutubeHistory = YoutubeHistory::find($youtube);
        if (!$existedYoutubeHistory) {
            return response()->json(['message' => 'Не удалось найти youtube канал с указанным id'], 404);
        }
        if (!Child::whereId($existedYoutubeHistory->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Этот сайт не принадлежит вашему ребенку'], 403);
        }
        $existedYoutubeHistory->delete();
        return response()->json(['message' => 'История посещения youtube канала была удалена'], 200);
    }
}
