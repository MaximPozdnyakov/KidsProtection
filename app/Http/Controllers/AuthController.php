<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\IsValidPassword;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    public function sendEmailVerificationCode($email, $userName)
    {
        $token = sprintf('%05d', rand(100000, 999999));
        DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token,
        ]);

        $to_name = $userName;
        $to_email = $email;
        $data = [
            'name' => $to_name,
            'token' => $token,
        ];
        Mail::send('verify_email',
            $data,
            function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject(\Config::get('mail.from.name') . ': ' . 'Подтвердите email');
                $message->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'));
            },
        );
    }

    public function index(Request $request)
    {
        return auth()->user();
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'pass' => 'required|string',
        ],
            [
                'email.required' => 'Укажите email',
                'email.email' => 'Укажите корректный email',
                'pass.required' => 'Укажите пароль',
            ]);
        $credentials = $request->only('email', 'pass');
        $existedUser = User::whereEmail($credentials['email'])->first();
        if (!$existedUser) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['email' => 'Веденный вами электронный адрес не связан ни с одним аккаунтом'],
            ], 404);
        }
        $attempt = Auth::attempt(['email' => $request->email, 'password' => $request->pass]);
        if (!$attempt) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['pass' => 'Вы ввели неверный пароль'],
            ], 404);
        }
        $token = auth()->user()->createToken('API Token')->accessToken;
        return response()->json($existedUser, 200, ['token' => $token]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'fio' => 'required|string',
            'email' => 'required|string|email|unique:users',
            'pass' => [
                'required',
                'string',
                new isValidPassword(),
            ],
            'termsAgree' => 'required|boolean',
        ],
            [
                'fio.required' => 'Укажите ФИО',
                'email.required' => 'Укажите email',
                'email.email' => 'Укажите корректный email',
                'email.unique' => 'Пользователь с такими email уже существует',
                'pass.required' => 'Укажите пароль',
            ]);
        if (!$request->termsAgree) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'termsAgree' => 'Примите условия использования',
                ],
            ], 404);
        }
        $data = $request->all();
        $user = User::create([
            'fio' => $data['fio'],
            'email' => $data['email'],
            'password' => Hash::make($data['pass']),
            'termsAgree' => $data['termsAgree'],
            'emailNotify' => true,
        ]);
        $token = $user->createToken('API Token')->accessToken;
        $this->sendEmailVerificationCode($data['email'], $data['fio']);
        return response()->json(User::find($user->id), 200, ['token' => $token]);
    }

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Вы вышли из аккаунта'], 200);
    }

    public function forgot(Request $request)
    {
        $request->email = $request[0];
        $request->validate(['0' => 'required|string|email'],
            [
                '0.required' => 'Укажите email',
                '0.email' => 'Укажите корректный email',
            ]);
        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['email' => 'Веденный вами электронный адрес не связан ни с одним аккаунтом'],
            ], 404);
        }

        $token = sprintf('%05d', rand(100000, 999999));
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        $to_name = $user->fio;
        $to_email = $request->email;
        $data = [
            'name' => $to_name,
            'token' => $token,
        ];
        Mail::send('reset_password',
            $data,
            function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject(\Config::get('mail.from.name') . ': ' . 'Запрос на смену пароля');
                $message->from(\Config::get('mail.from.address'), \Config::get('mail.from.name'));
            },
        );
        return response()->json(["message" => 'Код для сброса пароля отправлен на вашу электронную почту'], 200);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
            'pass' => [
                'required',
                'string',
                new isValidPassword(),
            ],
        ],
            [
                'token.required' => 'Укажите код для сброса пароля',
                'pass.required' => 'Укажите пароль',
            ]);
        $tokenData = DB::table('password_resets')->whereToken($request->token)->first();
        $user = null;
        if ($tokenData) {
            $user = User::whereEmail($tokenData->email)->first();
        }
        if (!$user) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => ['token' => 'Веденный вами код для сброса пароля недействителен'],
            ], 404);
        }
        $user->password = Hash::make($request->pass);
        $user->update();
        DB::table('password_resets')->whereEmail($user->email)->delete();
        return response()->json(["message" => 'Ваш пароль был успешно изменен'], 200);
    }

    public function update(Request $request)
    {
        $currentUser = User::find(auth()->user()->id);
        if ($request->has('fio') && $request->fio != $currentUser->fio) {
            $request->validate(['fio' => 'required|string'], ['fio.required' => 'Укажите ФИО']);
            $currentUser->fio = $request->fio;
        }
        if ($request->has('email') && $request->email != $currentUser->email) {
            $request->validate(['email' => 'required|string|email|unique:users'],
                [
                    'email.required' => 'Укажите email',
                    'email.email' => 'Укажите корректный email',
                    'email.unique' => 'Пользователь с такими email уже существует',
                ]
            );
            $currentUser->email = $request->email;
            $currentUser->emailVerified = 0;
            $this->sendEmailVerificationCode($request->email, $currentUser->fio);
        }
        if ($request->has('pass')) {
            $request->validate(['pass' => ['required', 'string', new isValidPassword()]], ['password.required' => 'Укажите пароль']);
            $currentUser->password = Hash::make($request->pass);
        }
        $currentUser->update();
        return response()->json($currentUser, 200);
    }

    public function verify_email(Request $request)
    {
        $request->token = $request[0];
        $request->validate(['0' => 'required|string'], ['0.required' => 'Укажите код для подтверждения email']);
        $tokenData = DB::table('password_resets')->whereToken($request->token)->first();
        $user = null;
        if ($tokenData) {
            $user = User::whereEmail($tokenData->email)->first();
        }
        if (!$user) {
            return response()->json(['message' => 'Веденный вами код для подтверждения email недействителен'], 404);
        }
        $user->emailVerified = 1;
        $user->update();
        DB::table('password_resets')->whereEmail($user->email)->delete();
        return response()->json(["message" => 'Ваша электронная почта была подтверждена'], 200);
    }

    public function send_email_verification_code()
    {
        $this->sendEmailVerificationCode(auth()->user()->email, auth()->user()->fio);
        return response()->json(["message" => 'Код для подтверждения email отправлен на вашу электронную почту'], 200);
    }
}
