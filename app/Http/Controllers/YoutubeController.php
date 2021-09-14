<?php

namespace App\Http\Controllers;

use App\Models\Youtube;
use Illuminate\Http\Request;

class YoutubeController extends Controller
{
    public function index(Request $request)
    {
        return Youtube::whereParent(auth()->user()->id)->whereChild($request->header('child'))->get()->pluck('channel');
    }

    public function store(Request $request)
    {
        $request->validate([
            'channel' => 'required|string',
            'child' => 'required|string',
        ]);
        if (Youtube::where('channel', 'LIKE', '%/' . $request->channel)->whereChild($request->child)
            ->orWhere('channel', $request->channel)->whereChild($request->child)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['channel' => 'Этот youtube канал уже заблокирован для указанного ребенка'],
            ], 404);
        }
        $youtube = Youtube::create([
            'channel' => $request->channel,
            'child' => $request->child,
            'parent' => auth()->user()->id,
        ]);
        return response()->json('Youtube канал заблокирован', 200);
    }

    public function destroy(Request $request)
    {
        $existedYoutube = Youtube::where('channel', 'LIKE', '%/' . $request->header('channel'))->whereChild($request->header('child'))
            ->orWhere('channel', $request->header('channel'))->whereChild($request->header('child'))->first();
        if (!$existedYoutube) {
            return response()->json('Не удалось найти youtube канал', 404);
        }
        $existedYoutube->delete();
        return response()->json('Youtube канал разблокирован', 200);
    }
}
