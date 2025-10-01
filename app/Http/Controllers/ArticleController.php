<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Список новостей с пагинацией
    public function index()
    {
        $articles = Article::latest()->paginate(5); // по 5 на страницу
        return view('articles.index', compact('articles'));
    }

    // Форма для создания новости
    public function create()
    {
        return view('articles.create');
    }

    // Сохранение новой новости
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:5',
        ]);

        Article::create($validated);

        return redirect()->route('articles.index')->with('success', 'Статья успешно создана!');
    }

    // Форма редактирования новости
    public function edit(Article $article)
    {
        return view('articles.edit', compact('article'));
    }

    // Обновление новости
    public function update(Request $request, Article $article)
    {
        $validated = $request->validate([
            'title' => 'required|min:3|max:255',
            'content' => 'required|min:5',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Статья успешно обновлена!');
    }

    // Удаление новости
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена!');
    }

    public function show($id)
    {
        $article = \App\Models\Article::findOrFail($id); // ищем статью по ID
        return view('articles.show', compact('article')); // передаём в шаблон
    }

}
