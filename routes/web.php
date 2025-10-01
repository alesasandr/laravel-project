<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;

// Главная — теперь через контроллер
Route::get('/', [MainController::class, 'index'])->name('home');

// Страница регистрации (форма)
Route::get('/signin', [AuthController::class, 'create'])->name('signin.create');

// Обработка формы (POST)
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.registration');

// Галерея — отдельная страница с full_image
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');

// О нас
Route::get('/about', function () {
    return view('about');
})->name('about');

// Контакты с динамическими данными
Route::get('/contacts', function () {
    $contacts = [
        ['name' => 'Иван Иванов', 'email' => 'ivan@example.com'],
        ['name' => 'Мария Петрова', 'email' => 'maria@example.com'],
        ['name' => 'Алексей Сидоров', 'email' => 'alex@example.com'],
    ];
    return view('contacts', compact('contacts'));
})->name('contacts');
