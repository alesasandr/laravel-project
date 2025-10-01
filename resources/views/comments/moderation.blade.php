@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
<div class="max-w-3xl mx-auto">
    <h2 class="text-2xl font-bold mb-4">Комментарии, ожидающие модерации</h2>

    @foreach($comments as $comment)
        <div class="bg-white p-4 shadow rounded mb-3">
            <p><strong>{{ $comment->author->name }}</strong> к статье <em>{{ $comment->article->title }}</em></p>
            <p>{{ $comment->content }}</p>

            <form method="POST" action="{{ route('comments.approve', $comment) }}" class="inline">
                @csrf
                @method('PATCH')
                <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">Одобрить</button>
            </form>

            <form method="POST" action="{{ route('comments.reject', $comment) }}" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">Отклонить</button>
            </form>
        </div>
    @endforeach

    @if($comments->isEmpty())
        <p>Нет комментариев для модерации.</p>
    @endif
</div>
@endsection
