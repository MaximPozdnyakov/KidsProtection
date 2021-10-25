<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        return $this->jsonResponse(Notification::whereUser(auth()->user()->id)->get(), 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'string|nullable',
            'msg' => 'string|nullable',
            'icon' => 'string|nullable',
            'child' => 'required|string',
            'user' => 'required|string',
        ]);
        Notification::create($request->all());
        return $this->jsonResponse('Уведомление отправлено', 200);
    }
}
