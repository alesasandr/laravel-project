<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Mail\NewArticleNotification;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ArticleController extends Controller
{
    // Список новостей с пагинацией
    public function index()
    {
        // Загружаем статьи с комментариями и их авторами, чтобы избежать N+1 запроса
        $articles = Article::with('comments.author')->latest()->paginate(5);
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

        // Получаем всех модераторов
        $moderators = User::whereHas('role', fn($q) => $q->where('name', 'moderator'))->get();

        // Отправляем письма модераторам
        foreach ($moderators as $moderator) {
            try {
                Mail::to($moderator->email)->send(new NewArticleNotification($article));
            } catch (\Exception $e) {
                \Log::error("Ошибка отправки письма модератору {$moderator->email}: " . $e->getMessage());
            }
        }

        // Отправляем тестовое письмо на твой ящик
        try {
            Mail::to('vasko.aleksandar@yandex.ru')->send(new NewArticleNotification($article));
        } catch (\Exception $e) {
            \Log::error("Ошибка отправки тестового письма: " . $e->getMessage());
        }

        return redirect()->route('articles.index')->with('success', 'Статья создана и модераторы уведомлены!');
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
        $article = Article::with('comments.author')->findOrFail($id); // загружаем комментарии с авторами
        return view('articles.show', compact('article'));
    }
}
