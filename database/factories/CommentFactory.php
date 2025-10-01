<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'article_id' => Article::factory(),
            'author_id' => User::inRandomOrder()->first()->id, // выбираем существующего пользователя
            'content' => $this->faker->paragraph(),
        ];
    }
}
