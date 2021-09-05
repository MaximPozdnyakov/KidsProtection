<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Child;
use Illuminate\Http\Request;

class CallsController extends Controller
{
    public function index(Request $request, $child)
    {
        return Call::where('parent', auth()->user()->id)->where('user', $child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
            'locked' => 'boolean',
            'user' => 'required|string',
        ],
            [
                'phone.required' => 'Параметр phone обязателен',
                'phone.string' => 'Параметр phone должен быть строкой',
                'locked.boolean' => 'Параметр locked должен быть булевым',
                'user.required' => 'Укажите id ребенка, которому принадлежит приложение',
                'user.string' => 'Параметр user должен быть строкой',
            ]);
        if (!preg_match('/^[0-9]{11}$/', $request->phone)) {
            return response()->json(['message' => 'The given data was invalid.', 'errors' => ['phone' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']], 400);
        }
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        if (Call::where('phone', $request->phone)->where("user", $request->user)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['phone' => 'Этот телефон уже добавлен в список телефонов указанного ребенка'],
            ], 400);
        }
        $call = Call::create([
            'phone' => $request->phone,
            'parent' => auth()->user()->id,
            'user' => $request->user,
            'locked' => $request->has('locked') ? $request->locked : 1,
        ]);
        return response()->json([
            'message' => 'Телефон добавлен',
            'data' => Call::find($call->id),
        ], 201);
    }

    public function show(Request $request, $child, $call)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return Call::where('id', $call)->where("user", $child)->first();
    }

    public function update(Request $request, $Call)
    {
        $existedCall = Call::where('id', $Call)->where("parent", auth()->user()->id)->first();
        if (!$existedCall) {
            return response()->json(['message' => 'Не удалось найти телефон с указанным id'], 404);
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean'], ['locked.boolean' => 'Параметр locked должен быть булевым значением']);
            $existedCall->locked = $request->locked;
            // CallHistory::where('phone', $existedCall->phone)->where('user', $existedCall->user)
            //     ->update(['locked' => $request->locked]);
        }
        $existedCall->update();
        return response()->json([
            'message' => 'Настройки телефона обновлены',
            'data' => $existedCall,
        ], 202);
    }

    public function destroy(Request $request, $call)
    {
        $existedCall = Call::where('id', $call)->where("parent", auth()->user()->id)->first();
        if (!$existedCall) {
            return response()->json(['message' => 'Не удалось найти телефон с указанным id'], 404);
        }
        $existedCall->delete();
        return response()->json(['message' => 'Телефон удален из списка телефонов'], 200);
    }
}
