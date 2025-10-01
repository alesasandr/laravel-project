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
        // Сначала вызываем сидеры ролей и пользователей
        $this->call([
            RolesTableSeeder::class,
            UsersTableSeeder::class,
        ]);

        // Создаём 5 статей с комментариями
        Article::factory(5)->create()->each(function ($article) {
            Comment::factory(3)->create([
                'article_id' => $article->id
            ]);
        });
    }
}
