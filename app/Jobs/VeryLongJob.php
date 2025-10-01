<?php

namespace App\Jobs;

use App\Models\Article;
use App\Mail\NewArticleNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class VeryLongJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $article;

    /**
     * Create a new job instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        // Получаем модераторов
        $moderators = \App\Models\User::whereHas('role', fn($q) => $q->where('name', 'moderator'))->get();

        foreach ($moderators as $moderator) {
            Mail::to($moderator->email)->send(new NewArticleNotification($this->article));
        }
    }
}
