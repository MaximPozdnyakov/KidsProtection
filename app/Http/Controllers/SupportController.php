<?php

namespace App\Http\Controllers;

use App\Models\SupportAppeal;
use App\Models\SupportTopic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|string',
            'description' => 'required|string',
            'date' => 'required|date|date_format:d.m.Y H:i',
        ], ['description.required' => 'Пожалуйста, опишите вашу проблему']);
        if (!SupportTopic::whereName($request->theme)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['theme' => 'Нельзя написать в поддержку на эту тему'],
            ], 400);
        }
        SupportAppeal::create([
            'theme' => $request->theme,
            'description' => $request->description,
            'date' => $request->date,
            'user' => auth()->user()->id,
        ]);
        $to_name = \Config::get('mail.from.name');
        $to_email = \Config::get('mail.from.address');
        $data = [
            'description' => $request->description,
            'date' => $request->date,
            'fio' => auth()->user()->fio,
            'email' => auth()->user()->email,
        ];
        Mail::send('support',
            $data,
            function ($message) use ($to_name, $to_email, $request) {
                $message->to($to_email, $to_name)->subject(\Config::get('mail.from.name') . ': ' . $request->theme);
                $message->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'));
            },
        );
        return response()->json(["message" => 'Спасибо, за обратную связь, мы ответим вам в ближайшее время'], 200);
    }
}
