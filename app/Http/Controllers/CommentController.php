<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'article_id' => 'required|exists:articles,id',
            'content' => 'required|min:3',
        ]);

        $validated['author_id'] = auth()->id(); // автоматически текущий пользователь

        Comment::create($validated);

        return redirect()->back()->with('success', 'Комментарий добавлен!');
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

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);
        $comment->delete();
        return redirect()->back()->with('success', 'Комментарий удалён!');
    }
}
