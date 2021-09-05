<?php

namespace App\Http\Controllers;

use App\Models\CallHistory;
use App\Models\Child;
use App\Models\Phone;
use App\Models\SmsHistory;
use Illuminate\Http\Request;

class PhonesController extends Controller
{
    public function index(Request $request, $child)
    {
        return Phone::where('parent', auth()->user()->id)->where('user', $child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|regex:/^[0-9]{11}$/',
            'locked' => 'boolean',
            'user' => 'required|string',
        ], ['phone.regex' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']);
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        if (Phone::where('phone', $request->phone)->where("user", $request->user)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['phone' => 'Этот телефон уже добавлен в список телефонов указанного ребенка'],
            ], 400);
        }
        $phone = Phone::create([
            'phone' => $request->phone,
            'parent' => auth()->user()->id,
            'user' => $request->user,
            'locked' => $request->get('locked', 1),
        ]);
        return response()->json([
            'message' => 'Телефон добавлен',
            'data' => Phone::find($phone->id),
        ], 201);
    }

    public function show(Request $request, $child, $phone)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return Phone::where('id', $phone)->where("user", $child)->first();
    }

    public function update(Request $request, $phone)
    {
        $existedPhone = Phone::where('id', $phone)->where("parent", auth()->user()->id)->first();
        if (!$existedPhone) {
            return response()->json(['message' => 'Не удалось найти телефон с указанным id'], 404);
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean']);
            $existedPhone->locked = $request->locked;
            CallHistory::where('phone', $existedPhone->phone)->where('user', $existedPhone->user)
                ->update(['locked' => $request->locked]);
            SmsHistory::where('phone', $existedPhone->phone)->where('user', $existedPhone->user)
                ->update(['locked' => $request->locked]);
        }
        $existedPhone->update();
        return response()->json([
            'message' => 'Настройки телефона обновлены',
            'data' => $existedPhone,
        ], 202);
    }

    public function destroy(Request $request, $phone)
    {
        $existedPhone = Phone::where('id', $phone)->where("parent", auth()->user()->id)->first();
        if (!$existedPhone) {
            return response()->json(['message' => 'Не удалось найти телефон с указанным id'], 404);
        }
        $existedPhone->delete();
        return response()->json(['message' => 'Телефон удален из списка телефонов'], 200);
    }
}
