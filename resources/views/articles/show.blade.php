@extends('layouts.app')

@section('title', $article->title)

@section('content')
<h2 class="text-2xl font-bold mb-2">{{ $article->title }}</h2>
<p class="mb-4">{{ $article->content }}</p>

<h3 class="text-xl font-semibold mb-2">Комментарии</h3>

@foreach($article->comments as $comment)
    <div class="p-2 mb-2 bg-gray-100 rounded shadow">
        <strong>{{ $comment->author }}</strong>: {{ $comment->content }}
        <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline ml-2">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-red-500 hover:underline">Удалить</button>
        </form>
    </div>
@endforeach

<h4 class="mt-4 mb-2 font-semibold">Добавить комментарий</h4>
<form action="{{ route('comments.store') }}" method="POST" class="
