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
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return CallHistory::where('user', $child)->where('phone', $phone)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => 'required|string|regex:/^[0-9]{11}$/',
            'incoming' => 'required|boolean',
            'date' => 'required|date|date_format:d.m.Y H:i',
            'user' => 'required|string',
        ], ['phone' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']);
        if (!Child::where('id', $request->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedCall = Phone::where('phone', $request->phone)->where("user", $request->user)->first();
        if (!$existedCall) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['phone' => 'Номер телефона ' . $request->phone . ' не существует в списке номеров указанного ребенка'],
            ], 400);
        }
        $callHistory = CallHistory::create([
            'phone' => $request->phone,
            'locked' => $existedCall->locked,
            'incoming' => $request->incoming,
            'date' => $request->date,
            'user' => $request->user,
        ]);
        return response()->json([
            'message' => 'Звонок добавлена',
            'data' => CallHistory::find($callHistory->id),
        ], 201);
    }

    public function show(Request $request, $child, $phone, $date)
    {
        if (!Child::where('id', $child)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return CallHistory::where('user', $child)->where('phone', $phone)
            ->where('date', 'LIKE', $date . '%')->get();
    }

    public function destroy(Request $request, $call)
    {
        $existedCallHistory = CallHistory::find($call);
        if (!$existedCallHistory) {
            return response()->json(['message' => 'Не удалось найти историю звонка с указанным id'], 404);
        }
        if (!Child::where('id', $existedCallHistory->user)->where("parent", auth()->user()->id)->first()) {
            return response()->json(['message' => 'Этот звонок не принадлежит вашему ребенку'], 403);
        }
        $existedCallHistory->delete();
        return response()->json(['message' => 'Звонок была удалена'], 200);
    }
}
