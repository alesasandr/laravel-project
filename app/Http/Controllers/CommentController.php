<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'article_id' => 'required|exists:articles,id',
        ]);

        $comment = Comment::create([
            'content' => $validated['content'],
            'article_id' => $validated['article_id'],
            'author_id' => auth()->id(),
            'is_approved' => false, // по умолчанию не одобрен
        ]);

        return redirect()->back()->with('success', 'Ваш комментарий добавлен и ожидает модерации.');
    }

    public function edit(Comment $comment)
    {
        $this->authorize('update', $comment);
        return view('comments.edit', compact('comment'));
    }

    public function update(Request $request, Comment $comment)
    {
        $this->authorize('update', $comment);

        $validated = $request->validate([
            'content' => 'required|min:1',
        ]);

        $comment->update($validated);

        return redirect()->back()->with('success', 'Комментарий обновлён!');
    }

    // Метод для отображения страницы модерации
    public function moderation()
    {
        $this->authorize('moderate', Comment::class);

        $comments = Comment::where('is_approved', false)->get();
        return view('comments.moderation', compact('comments'));
    }

    // Метод для одобрения комментария
    public function approve(Comment $comment)
    {
        $this->authorize('moderate', $comment);

        $comment->is_approved = true;
        $comment->save();

        return redirect()->back()->with('success', 'Комментарий одобрен!');
    }

    // Метод для отклонения комментария
    public function reject(Comment $comment)
    {
        $this->authorize('moderate', $comment);

        $comment->delete();

        return redirect()->back()->with('success', 'Комментарий отклонен!');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back()->with('success', 'Комментарий удалён!');
    }
}
