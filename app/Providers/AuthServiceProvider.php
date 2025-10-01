<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Article;
use App\Policies\ArticlePolicy;
use App\Models\Comment;
use App\Policies\CommentPolicy;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * Политики аутентификации для моделей.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Article::class => ArticlePolicy::class,
        Comment::class => CommentPolicy::class, // <-- Здесь регистрируем политику для комментариев
    ];

    /**
     * Зарегистрировать любые службы аутентификации.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Здесь можно добавлять Gates
    }
}
