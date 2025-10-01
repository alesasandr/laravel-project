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
            'author' => 'required|min:2|max:255',
            'content' => 'required|min:3',
        ]);

        Comment::create($validated);

        return redirect()->back()->with('success', 'Комментарий добавлен!');
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();
        return redirect()->back()->with('success', 'Комментарий удалён!');
    }
}
