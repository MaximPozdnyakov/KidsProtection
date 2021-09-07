<?php

namespace App\Http\Controllers;

use App\Models\CallHistory;
use App\Models\Child;
use App\Models\Phone;
use Illuminate\Http\Request;

class CallHistoryController extends Controller
{
    public function index(Request $request, $child, $phone)
    {
        return CallHistory::whereUser($child)->wherePhone($phone)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'regex:/^[0-9]{11}$/'],
            'incoming' => 'required|boolean',
            'date' => 'required|date|date_format:d.m.Y H:i',
            'user' => 'required|string',
        ], ['phone' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']);
        $existedCall = Phone::wherePhone($request->phone)->whereUser($request->user)->first();
        if (!$existedCall) {
            return response()->json(['message' => 'Номер телефона ' . $request->phone . ' не существует в списке номеров указанного ребенка'], 404);
        }
        $callHistory = CallHistory::create([
            'phone' => $request->phone,
            'locked' => $existedCall->locked,
            'incoming' => $request->incoming,
            'date' => $request->date,
            'user' => $request->user,
        ]);
        return response()->json([
            'message' => 'Звонок добавлен',
            'data' => CallHistory::find($callHistory->id),
        ], 201);
    }

    public function show(Request $request, $child, $phone, $date)
    {
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return CallHistory::whereUser($child)->wherePhone($phone)
            ->where('date', 'LIKE', $date . '%')->get();
    }

    public function destroy(Request $request, $call)
    {
        $existedCallHistory = CallHistory::find($call);
        if (!$existedCallHistory) {
            return response()->json(['message' => 'Не удалось найти звонок с указанным id'], 404);
        }
        if (!Child::whereId($existedCallHistory->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Этот звонок не принадлежит вашему ребенку'], 403);
        }
        $existedCallHistory->delete();
        return response()->json(['message' => 'Звонок был удалена'], 200);
    }
}
