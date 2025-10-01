<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
		{
				$jsonPath = public_path('data/data.json');

				if (!file_exists($jsonPath)) {
						$items = []; // если файл не найден, создаём пустой массив
				} else {
						$json = file_get_contents($jsonPath);
						$items = json_decode($json, true) ?? [];
				}

				return view('home', compact('items'));
		}


    public function gallery($id)
    {
        $json = file_get_contents(public_path('data/data.json'));
        $data = json_decode($json, true);

        // Находим нужный элемент по ID
        $item = $data[$id] ?? null;

        if (!$item) {
            abort(404);
        }

        return view('gallery', compact('item'));
    }
}
