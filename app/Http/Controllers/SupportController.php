<?php

namespace App\Http\Controllers;

use App\Models\SupportAppeal;
use App\Models\SupportTopic;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function index(Request $request)
    {
        return SupportTopic::get()->pluck('name');
    }

    public function store(Request $request)
    {
        $request->validate([
            'theme' => 'required|string',
            'message' => 'required|string',
            'fio' => 'required|string',
            'email' => 'required|string|email',
        ]);
        if (!SupportTopic::whereName($request->theme)->first()) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['theme' => 'Нельзя написать в поддержку на эту тему'],
            ], 404);
        }
        SupportAppeal::create([
            'theme' => $request->theme,
            'message' => $request->message,
            'date' => Carbon::now()->format('d.m.Y H:i'),
            'fio' => $request->fio,
            'email' => $request->email,
            'user' => auth()->user() ? auth()->user()->id : '',
        ]);
        $to_name = \Config::get('mail.from.name');
        $to_email = \Config::get('mail.from.address');
        $data = [
            'description' => $request->message,
            'date' => Carbon::now()->format('d.m.Y H:i'),
            'fio' => $request->fio,
            'email' => $request->email,
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
