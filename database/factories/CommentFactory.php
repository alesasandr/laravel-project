<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Article;

class CommentFactory extends Factory
{
    protected $model = \App\Models\Comment::class;

    public function definition(): array
    {
        return [
            'article_id' => Article::factory(), // автоматически создаёт статью для комментария
            'author' => $this->faker->name,
            'content' => $this->faker->sentence,
        ];
    }
}
