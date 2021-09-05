<?php

namespace App\Http\Controllers;

use App\Models\Child;
use App\Models\Phone;
use App\Models\SmsHistory;
use Illuminate\Http\Request;

class SmsHistoryController extends Controller
{
    public function index(Request $request, $child, $phone)
    {
        if (!Child::whereId($child)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        return SmsHistory::whereUser($child)->wherePhone($phone)->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'regex:/^[0-9]{11}$/'],
            'msg' => 'string',
            'incoming' => 'required|boolean',
            'date' => 'required|date|date_format:d.m.Y H:i',
            'user' => 'required|string',
        ], ['phone.regex' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']);
        if (!Child::whereId($request->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $existedSms = Phone::wherePhone($request->phone)->whereUser($request->user)->first();
        if (!$existedSms) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['phone' => 'Номер телефона ' . $request->phone . ' не существует в списке номеров указанного ребенка'],
            ], 400);
        }
        $SmsHistory = SmsHistory::create([
            'phone' => $request->phone,
            'msg' => $request->get('msg', null),
            'locked' => $existedSms->locked,
            'incoming' => $request->incoming,
            'date' => $request->date,
            'user' => $request->user,
        ]);
        return response()->json([
            'message' => 'История смс добавлена',
            'data' => SmsHistory::find($SmsHistory->id),
        ], 201);
    }

    public function show(Request $request, $child, $phone, $date)
    {
        if (!Child::whereId($child)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Указанный ребенок вам не принадлежит'], 403);
        }
        $d = \DateTime::createFromFormat('d.m.Y', $date);
        if (!($d && $d->format('d.m.Y') === $date)) {
            return response()->json(['message' => 'Параметр date должен быть датой формата dd.MM.yyyy'], 400);
        }
        return SmsHistory::whereUser($child)->wherePhone($phone)
            ->where('date', 'LIKE', $date . '%')->get();
    }

    public function destroy(Request $request, $sms)
    {
        $existedSmsHistory = SmsHistory::find($sms);
        if (!$existedSmsHistory) {
            return response()->json(['message' => 'Не удалось найти смс с указанным id'], 404);
        }
        if (!Child::whereId($existedSmsHistory->user)->whereParent(auth()->user()->id)->first()) {
            return response()->json(['message' => 'Это смс не принадлежит вашему ребенку'], 403);
        }
        $existedSmsHistory->delete();
        return response()->json(['message' => 'Смс было удалено'], 200);
    }
}
