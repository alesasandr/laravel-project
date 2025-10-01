<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Список новостей с пагинацией
    public function index()
    {
        // Загружаем статьи с комментариями и их авторами, чтобы избежать N+1 запроса
        $articles = Article::with('comments.author')->latest()->paginate(5);
        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    public function store(Request $request)
    {
        $this->authorize('create', Article::class);
        // валидация и создание статьи
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);
        // валидация и обновление
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена!');
    }


    // Просмотр одной новости
    public function show($id)
    {
        $article = Article::findOrFail($id); // ищем статью по ID
        return view('articles.show', compact('article')); // передаём в шаблон
    }
}
