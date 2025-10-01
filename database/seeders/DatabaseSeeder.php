<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Article;
use App\Models\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Создаём 5 статей
        Article::factory(5)->create()->each(function ($article) {
            // Для каждой статьи создаём 3 комментария
            Comment::factory(3)->create([
                'article_id' => $article->id
            ]);
        });

        // Дополнительно можно создать "ручные" статьи, если нужно
        /*
        $article = Article::create([
            'title' => 'Пример статьи',
            'content' => 'Это пример содержания статьи.'
        ]);

        Comment::create([
            'article_id' => $article->id,
            'author' => 'Иван Иванов',
            'content' => 'Пример комментария к статье.'
        ]);
        */
    }
}
