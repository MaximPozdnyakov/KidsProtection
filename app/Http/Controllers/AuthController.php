<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Rules\IsValidPassword;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Laravel\Passport\Token;

class AuthController extends Controller
{
    /**
     * @api {get} /api/users Получить авторизированного пользователя
     * @apiName              GetUser
     * @apiGroup             User
     * @apiHeaderExample     {"Authorization": "Bearer {token}"}
     */

    public function index(Request $request)
    {
        return auth()->user();
    }

    /**
     * @api {post} /api/users/login Авторизация
     * @apiName                     LoginUser
     * @apiGroup                    User
     * @apiParam email              Email пользователя
     * @apiParam password           Пароль пользователя
     */

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ],
            [
                'email.required' => 'Укажите email',
                'email.email' => 'Укажите корректный email',
                'password.required' => 'Укажите пароль',
            ]);
        $credentials = $request->only('email', 'password');
        $existedUser = User::whereEmail($credentials['email'])->first();
        if (!$existedUser) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => 'Веденный вами электронный адрес не связан ни с одним аккаунтом',
                ],
            ], 400);
        }
        $attempt = Auth::attempt($credentials);
        if (!$attempt) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'password' => 'Вы ввели неверный пароль',
                ],
            ], 400);
        }
        $token = auth()->user()->createToken('API Token')->accessToken;
        return response()->json([
            'message' => 'Вы успешно авторизовались',
            'data' => [
                'token' => $token,
                'user' => auth()->user(),
            ],
        ], 200);
    }

    /**
     * @api {post} /api/users/register Регистрация
     * @apiName                        RegisterUser
     * @apiGroup                       User
     * @apiParam name                  ФИО пользователя
     * @apiParam email                 Email пользователя
     * @apiParam password              Пароль пользователя
     */

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => [
                'required',
                new isValidPassword(),
            ],
        ],
            [
                'name.required' => 'Укажите ФИО',
                'email.required' => 'Укажите email',
                'email.email' => 'Укажите корректный email',
                'email.unique' => 'Пользователь с такими email уже существует',
                'password.required' => 'Укажите пароль',
            ]);
        $data = $request->all();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        $token = $user->createToken('API Token')->accessToken;
        return response()->json([
            'message' => 'Вы успешно зарегистрировались',
            'data' => [
                'token' => $token,
                'user' => $user,
            ],
        ], 201);
    }

    /**
     * @api {get} /api/users/logout Выйти из аккаунта
     * @apiName                     LogoutUser
     * @apiGroup                    User
     * @apiHeaderExample            {"Authorization": "Bearer {token}"}
     */

    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Вы вышли из аккаунта'], 200);
    }

    /**
     * @api {post} /api/users/forgot Отправка шестизначного кода для сброса пароля на почту
     * @apiName                      ForgotUserPassword
     * @apiGroup                     User
     * @apiParam email               Email пользователя
     */

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ],
            [
                'email.required' => 'Укажите email',
                'email.email' => 'Укажите корректный email',
            ]);
        $user = User::whereEmail($request->email)->first();
        if (!$user) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'email' => 'Веденный вами электронный адрес не связан ни с одним аккаунтом',
                ],
            ], 400);
        }

        $token = sprintf('%05d', rand(100000, 999999));
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
        ]);

        $to_name = $user->name;
        $to_email = $request->email;
        $data = [
            'name' => $to_name,
            'token' => $token,
        ];
        Mail::send('mail',
            $data,
            function ($message) use ($to_name, $to_email) {
                $message->to($to_email, $to_name)->subject('Kids Protection: Запрос на смену пароля');
                $message->from('support@kidsprotection.ru', 'Kids Protection');
            },
        );
        return response()->json([
            "message" => 'Код для сброса пароля отправлен на вашу электронную почту',
        ], 200);
    }

    /**
     * @api {post} /api/users/forgot Сброс пароля
     * @apiName                      ResetUserPassword
     * @apiGroup                     User
     * @apiParam token               Шестизначный код для сброса пароля
     * @apiParam password            Новый пароль
     */

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => [
                'required',
                new isValidPassword(),
            ],
        ],
            [
                'token.required' => 'Укажите код для сброса пароля',
                'password.required' => 'Укажите пароль',
            ]);
        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();
        $user = null;
        if ($tokenData) {
            $user = User::where('email', $tokenData->email)->first();
        }
        if (!$user) {
            return response()->json([
                'message' => 'The given data was invalid.',
                'errors' => [
                    'token' => 'Веденный вами код для сброса пароля недействителен',
                ],
            ], 400);
        }
        $user->password = Hash::make($request->password);
        $user->update();
        DB::table('password_resets')->where('email', $user->email)->delete();
        return response()->json([
            "message" => 'Ваш пароль был успешно изменен',
        ], 202);
    }
}