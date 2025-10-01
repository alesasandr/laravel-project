<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Jobs\VeryLongJob;
use Illuminate\Support\Facades\Log;

class ArticleController extends Controller
{
    // Список новостей с пагинацией
    public function index()
    {
        // Загружаем статьи с комментариями и их авторами, чтобы избежать N+1 запроса
        $articles = Article::with(['comments' => fn($q) => $q->where('is_approved', true)->with('author')])
                           ->latest()
                           ->paginate(5);
        return view('articles.index', compact('articles'));
    }

    // Форма создания новости
    public function create()
    {
        $this->authorize('create', Article::class);
        return view('articles.create');
    }

    // Сохраняем новую статью
    public function store(Request $request)
    {
        $this->authorize('create', Article::class);

        // Валидация
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Создаем статью
        $article = Article::create($validated);

        // Отправляем уведомления через очередь
        try {
            VeryLongJob::dispatch($article);
        } catch (\Exception $e) {
            Log::error("Ошибка постановки задачи в очередь: " . $e->getMessage());
        }

        return redirect()->route('articles.index')
                         ->with('success', 'Статья создана и уведомления отправлены модераторам!');
    }

    // Форма редактирования новости
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('articles.edit', compact('article'));
    }

    // Обновляем новость
    public function update(Request $request, Article $article)
    {
        $this->authorize('update', $article);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article->update($validated);

        return redirect()->route('articles.index')->with('success', 'Статья обновлена!');
    }

    // Удаляем новость
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles.index')->with('success', 'Статья удалена!');
    }

    // Просмотр одной новости
    public function show($id)
    {
        // Загружаем только одобренные комментарии
        $article = Article::with(['comments' => fn($q) => $q->where('is_approved', true)->with('author')])
                          ->findOrFail($id);
        return view('articles.show', compact('article'));
    }
}
