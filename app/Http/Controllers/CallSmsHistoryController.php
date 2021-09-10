<?php

namespace App\Http\Controllers;

use App\Models\CallSmsHistory;
use Illuminate\Http\Request;

class CallSmsHistoryController extends Controller
{
    public function index(Request $request)
    {
        $d = \DateTime::createFromFormat('d.m.Y', $request->header('date'));
        if (!($d && $d->format('d.m.Y') === $request->header('date'))) {
            return response()->json(['message' => 'date должен быть датой формата dd.MM.yyyy'], 404);
        }
        return CallSmsHistory::whereChild($request->header('child'))->where('date', 'LIKE', $request->header('date') . '%')->get()->makeHidden(['id', 'child']);
    }

    public function store(Request $request)
    {
        $request->validate([
            'child' => 'required|string',
            'phones.*.phone' => ['required', 'string', 'regex:/^\+[0-9]{11}$/'],
            'phones.*.message' => 'string',
            'phones.*.input' => 'required|boolean',
            'phones.*.isCall' => 'required|boolean',
            'phones.*.date' => 'required|date|date_format:d.m.Y H:i:s',
        ], ['phones.*.regex' => 'Параметр phone должен быть валидным номером телефона без спец символов начинающийся с кода страны']);
        $phones = $request->all()['phones'];
        foreach ($phones as $index => $phone) {
            $phones[$index]['message'] = $phone['msg'];
            unset($phones[$index]['msg']);
            $phones[$index]['child'] = $request->child;
        }
        $geolocation = CallSmsHistory::insert($phones);
        return response()->json(['message' => 'Звонки и смс добавлены'], 200);
    }
}
