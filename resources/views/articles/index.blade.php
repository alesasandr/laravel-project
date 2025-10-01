@extends('layouts.app')

@section('title', 'Новости')

@section('content')
<h2 class="text-2xl font-bold mb-4">Новости</h2>

@if(session('success'))
    <p class="text-green-500 mb-4">{{ session('success') }}</p>
@endif

<a href="{{ route('articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">Создать новость</a>

<ul class="space-y-4">
    @foreach($articles as $article)
        <li class="p-4 bg-white shadow rounded">
            <h3 class="text-lg font-bold">{{ $article->title }}</h3>
            <p>{{ $article->content }}</p>
            <div class="mt-2 space-x-2">
                <a href="{{ route('articles.edit', $article) }}" class="text-blue-500 hover:underline">Редактировать</a>
                <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline">Удалить</button>
                </form>
                <a href="{{ route('articles.show', $article) }}" class="text-green-500 hover:underline">Просмотр</a>
            </div>
        </li>
    @endforeach
</ul>

<div class="mt-4">
    {{ $articles->links() }}
</div>
@endsection
