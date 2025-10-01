<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Показать форму
    public function create()
    {
        return view('auth.signin');
    }

    // Обработка формы
    public function registration(Request $request)
    {
        // Валидация входных данных
        $validated = $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Возвращаем JSON-ответ
        return response()->json([
            'status' => 'success',
            'message' => 'Регистрация прошла успешно!',
            'data' => $validated
        ]);
    }
}
