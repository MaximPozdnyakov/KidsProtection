<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
     */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (!$credentials['email']) {
            return redirect()->back()->withErrors(['email' => 'Укажите email']);
        }
        if (!$credentials['password']) {
            return redirect()->back()->withErrors(['email' => 'Укажите пароль']);
        }
        if ($credentials['email'] != \Config::get('auth.admin_email')) {
            return redirect()->back()->withErrors(['email' => 'Зайти в админ панель может только администратор']);
        }
        if (Auth::attempt($credentials)) {
            return redirect('/admin');
        }
        return redirect()->back()->withErrors(['password' => 'Вы ввели неверный пароль']);
    }
}
