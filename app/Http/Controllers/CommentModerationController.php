<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentModerationController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:moderate-comments'); // создадим политику
    }

    public function moderation()
    {
        $comments = Comment::where('is_approved', false)->latest()->get();
        return view('comments.moderation', compact('comments'));
    }

    public function approve(Comment $comment)
    {
        $comment->update(['is_approved' => true]);
        return redirect()->route('comments.moderation')->with('success', 'Комментарий одобрен.');
    }

    public function reject(Comment $comment)
    {
        $comment->delete();
        return redirect()->route('comments.moderation')->with('success', 'Комментарий удалён.');
    }
}

