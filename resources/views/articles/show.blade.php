@extends('layouts.app')

@section('title', $article->title)

@section('content')
<h2 class="text-2xl font-bold mb-2">{{ $article->title }}</h2>
<p class="mb-4">{{ $article->content }}</p>

<div class="mb-4 space-x-2">
    {{-- Редактировать статью только модератор --}}
    @can('update', $article)
        <a href="{{ route('articles.edit', $article) }}" class="text-blue-500 hover:underline">Редактировать</a>
    @endcan

    {{-- Удалить статью только модератор --}}
    @can('delete', $article)
        <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline">Удалить</button>
        </form>
    @endcan
</div>

<h3 class="text-xl font-semibold mb-2">Комментарии</h3>

@foreach($article->comments as $comment)
    <div class="p-2 mb-2 bg-gray-100 rounded shadow">
        <strong>{{ $comment->author ?? 'Гость' }}</strong>: {{ $comment->content }}
        
        {{-- Редактировать комментарий только модератор --}}
        @can('update', $comment)
            <a href="{{ route('comments.edit', $comment) }}" class="text-blue-500 hover:underline ml-2">Редактировать</a>
        @endcan

        {{-- Удалить комментарий только модератор --}}
        @can('delete', $comment)
            <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:underline ml-1">Удалить</button>
            </form>
        @endcan
    </div>
@endforeach

{{-- Форма добавления комментария для всех авторизованных пользователей --}}
@auth
<h4 class="mt-4 mb-2 font-semibold">Добавить комментарий</h4>
<form action="{{ route('comments.store') }}" method="POST" class="mb-4">
    @csrf
    <input type="hidden" name="article_id" value="{{ $article->id }}">
    <input type="text" name="content" placeholder="Ваш комментарий" class="border rounded px-2 py-1 w-2/3">
    <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Добавить</button>
</form>
@endauth
@endsection
