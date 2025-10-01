<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;

class AuthController extends Controller
{
    // Форма регистрации
    public function create()
    {
        return view('auth.signin');
    }

    // Регистрация нового пользователя
    public function registration(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed', // поле password_confirmation обязательно
        ]);

        // Получаем роль по умолчанию (reader)
        $defaultRole = Role::where('name', 'reader')->first();

        $user = User::create([
            'name' => $request->name,
            'email'=> $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $defaultRole ? $defaultRole->id : null,
        ]);

        return redirect()->route('login.create')->with('success', 'Регистрация успешна! Войдите в систему.');
    }

    // Форма авторизации
    public function loginForm()
    {
        return view('auth.login');
    }

    // Аутентификация пользователя
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|string',
        ]);

        if(Auth::attempt($request->only('email','password'))) {
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        return back()->withErrors([
            'email'=>'Неверный email или пароль',
        ]);
    }

    // Выход пользователя
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
