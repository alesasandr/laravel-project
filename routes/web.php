<?php

use Illuminate\Support\Facades\Route;

// Главная
Route::get('/', function () {
    return view('home');
})->name('home');

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
