<?php

namespace App\Http\Controllers;

use App\Models\CallHistory;
use App\Models\Phone;
use App\Models\SmsHistory;
use Illuminate\Http\Request;

class PhonesController extends Controller
{
    public function index(Request $request, $child)
    {
        return Phone::whereParent(auth()->user()->id)->whereUser($child)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'regex:/^[0-9]{11}$/'],
            'locked' => 'boolean',
            'user' => 'required|string',
        ], ['phone.regex' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']);
        if (Phone::wherePhone($request->phone)->whereUser($request->user)->first()) {
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
        return Phone::whereId($phone)->whereUser($child)->first();
    }

    public function update(Request $request, $phone)
    {
        $existedPhone = Phone::whereId($phone)->whereParent(auth()->user()->id)->first();
        if (!$existedPhone) {
            return response()->json(['message' => 'Не удалось найти телефон с указанным id'], 404);
        }
        if ($request->has('locked')) {
            $request->validate(['locked' => 'boolean']);
            $existedPhone->locked = $request->locked;
            CallHistory::wherePhone($existedPhone->phone)->whereUser($existedPhone->user)
                ->update(['locked' => $request->locked]);
            SmsHistory::wherePhone($existedPhone->phone)->whereUser($existedPhone->user)
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
        $existedPhone = Phone::whereId($phone)->whereParent(auth()->user()->id)->first();
        if (!$existedPhone) {
            return response()->json(['message' => 'Не удалось найти телефон с указанным id'], 404);
        }
        $existedPhone->delete();
        return response()->json(['message' => 'Телефон удален из списка телефонов'], 200);
    }
}
