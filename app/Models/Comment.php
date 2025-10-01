<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_id',
        'author_id',
        'content',
        'is_approved', // добавляем
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


