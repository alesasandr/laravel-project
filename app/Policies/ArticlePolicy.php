<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

class ArticlePolicy
{
    /**
     * Любой пользователь может просматривать список статей
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Любой пользователь может просматривать отдельную статью
     */
    public function view(User $user, Article $article): bool
    {
        return true;
    }

    /**
     * Только модератор может создавать статьи
     */
    public function create(User $user): bool
    {
        return $user->isModerator();
    }

    /**
     * Только модератор может редактировать статьи
     */
    public function update(User $user, Article $article): bool
    {
        return $user->isModerator();
    }

    /**
     * Только модератор может удалять статьи
     */
    public function delete(User $user, Article $article): bool
    {
        return $user->isModerator();
    }

    public function restore(User $user, Article $article): bool
    {
        return false;
    }

    public function forceDelete(User $user, Article $article): bool
    {
        return false;
    }
}
