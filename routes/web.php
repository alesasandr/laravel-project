<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Веб-маршруты
|--------------------------------------------------------------------------
*/

// Главная — через контроллер
Route::get('/', [MainController::class, 'index'])->name('home');

// Страница регистрации (форма)
Route::get('/signin', [AuthController::class, 'create'])->name('signin.create');
// Обработка формы регистрации (POST)
Route::post('/signin', [AuthController::class, 'registration'])->name('signin.registration');

// Авторизация
Route::get('/login', [AuthController::class, 'loginForm'])->name('login.create');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

// Выход пользователя
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Галерея — отдельная страница с full_image
Route::get('/gallery/{id}', [MainController::class, 'gallery'])->name('gallery');

// Защищённый маршрут для аутентифицированных пользователей
Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/dashboard', function() {
        return view('dashboard');
    })->name('dashboard');
});

// Статические страницы
Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = [
        ['name' => 'Иван Иванов', 'email' => 'ivan@example.com'],
        ['name' => 'Мария Петрова', 'email' => 'maria@example.com'],
        ['name' => 'Алексей Сидоров', 'email' => 'alex@example.com'],
    ];
    return view('contacts', compact('contacts'));
})->name('contacts');

// Новости и CRUD для статей
Route::resource('articles', ArticleController::class);

// Комментарии (только store и destroy)
Route::resource('comments', CommentController::class)->only(['store', 'destroy']);
