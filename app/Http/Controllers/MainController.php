<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        // Загружаем JSON
        $json = file_get_contents(public_path('data/data.json'));
        $items = json_decode($json, true);

        // Передаём в шаблон
        return view('home', compact('items'));
    }

    public function gallery($id)
    {
        $json = file_get_contents(public_path('data/data.json'));
        $items = json_decode($json, true);

        // Находим нужный элемент по ID
        $item = $items[$id] ?? null;

        if (!$item) {
            abort(404);
        }

        return view('gallery', compact('item'));
    }
}
