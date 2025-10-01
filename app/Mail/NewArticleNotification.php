<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Article; // <- исправлено, правильный namespace модели

class NewArticleNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $article;

    /**
     * Create a new message instance.
     */
    public function __construct(Article $article)
    {
        $this->article = $article;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Новая статья создана')
                    ->view('emails.new_article');
    }
}
