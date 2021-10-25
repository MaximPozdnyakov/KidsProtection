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
            return $this->jsonResponse('date должен быть датой формата dd.MM.yyyy', 404);
        }
        return $this->jsonResponse(CallSmsHistory::whereChild($request->header('child'))->where('date', 'LIKE', $request->header('date') . '%')->get()->makeHidden(['id', 'child']));
    }

    public function store(Request $request)
    {
        $request->validate([
            'child' => 'required|string',
            'phones' => 'nullable',
            'phones.*.phone' => ['required', 'string'],
            'phones.*.message' => 'string',
            'phones.*.input' => 'required|boolean',
            'phones.*.isCall' => 'required|boolean',
            'phones.*.date' => 'required|date|date_format:d.m.Y H:i:s',
        ]);
        $phones = $request->all()['phones'];
        foreach ($phones as $index => $phone) {
            $phones[$index]['message'] = $phone['msg'];
            unset($phones[$index]['msg']);
            $phones[$index]['child'] = $request->child;
        }
        $geolocation = CallSmsHistory::insert($phones);
        return $this->jsonResponse('Звонки и смс добавлены', 200);
    }
}
