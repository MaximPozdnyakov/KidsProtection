<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;

class PhonesController extends Controller
{
    public function index(Request $request)
    {
        return $this->jsonResponse(Phone::whereParent(auth()->user()->id)->whereChild($request->header('child'))->get()->pluck('phone'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'phone' => ['required', 'string', 'regex:/^\+[0-9]{11}$/'],
            'child' => 'required|string',
        ], ['phone.regex' => 'Параметр phone должен быть валидным номером телефона начинающийся с кода страны']);

        if (Phone::wherePhone($request->phone)->whereChild($request->user)->first()) {
            return $this->jsonResponse([
                'message' => 'The given data was invalid.',
                'errors' => ['phone' => 'Этот телефон уже заблокирован для указанного ребенка'],
            ], 404);
        }
        $phone = Phone::create([
            'phone' => $request->phone,
            'parent' => auth()->user()->id,
            'child' => $request->child,
        ]);
        return $this->jsonResponse('Телефон заблокирован', 200);
    }

    public function destroy(Request $request)
    {
        $existedPhone = Phone::wherePhone($request->header('phone'))->whereChild($request->header('child'))->first();
        if (!$existedPhone) {
            return $this->jsonResponse('Не удалось найти телефон', 404);
        }
        $existedPhone->delete();
        return $this->jsonResponse('Телефон разблокирован', 200);
    }
}
