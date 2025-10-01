<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'content',
        'author_id', // теперь только author_id
    ];

    // Автор комментария
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    // Статья
    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}


