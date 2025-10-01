<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    // Любой авторизованный пользователь может создавать комментарий
    public function create(User $user)
    {
        return true;
    }

    // Автор комментария или модератор может редактировать
    public function update(User $user, Comment $comment)
    {
        return $user->isModerator() || $comment->author_id === $user->id;
    }

    // Автор комментария или модератор может удалить
    public function delete(User $user, Comment $comment)
    {
        return $user->isModerator() || $comment->author_id === $user->id;
    }

    public function moderate(User $user)
    {
        return $user->role && $user->role->name === 'moderator';
    }

    // Просмотр доступен всем
    public function viewAny(User $user) { return true; }
    public function view(User $user, Comment $comment) { return true; }

    public function restore(User $user, Comment $comment): bool { return false; }
    public function forceDelete(User $user, Comment $comment): bool { return false; }
}
