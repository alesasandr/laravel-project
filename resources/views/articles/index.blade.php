@extends('layouts.app')

@section('title', 'Новости')

@section('content')
<h2 class="text-2xl font-bold mb-4">Новости</h2>

@if(session('success'))
    <p class="text-green-500 mb-4">{{ session('success') }}</p>
@endif

{{-- Кнопка "Создать новость" только для модератора --}}
@can('create', App\Models\Article::class)
    <a href="{{ route('articles.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-4 inline-block">
        Создать новость
    </a>
@endcan

<ul class="space-y-4">
    @foreach($articles as $article)
        <li class="p-4 bg-white shadow rounded">
            <h3 class="text-lg font-bold">{{ $article->title }}</h3>
            <p>{{ $article->content }}</p>
            <div class="mt-2 space-x-2">
                @can('update', $article)
                    <a href="{{ route('articles.edit', $article) }}" class="text-blue-500 hover:underline">Редактировать</a>
                @endcan

                @can('delete', $article)
                    <form action="{{ route('articles.destroy', $article) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:underline">Удалить</button>
                    </form>
                @endcan

                <a href="{{ route('articles.show', $article) }}" class="text-green-500 hover:underline">Просмотр</a>
            </div>

            {{-- Комментарии --}}
            <div class="mt-4">
                <h4 class="font-semibold">Комментарии:</h4>
                <ul class="ml-4 space-y-2">
                    {{-- показываем только прошедшие модерацию --}}
                    @foreach($article->comments->where('is_approved', true) as $comment)
                        <li>
                            <strong>{{ $comment->author->name ?? $comment->author ?? 'Гость' }}</strong>: {{ $comment->content }}

                            {{-- Редактировать комментарий только автор или модератор --}}
                            @can('update', $comment)
                                <a href="{{ route('comments.edit', $comment) }}" class="text-blue-500 hover:underline ml-2">Редактировать</a>
                            @endcan

                            {{-- Удалить комментарий только автор или модератор --}}
                            @can('delete', $comment)
                                <form action="{{ route('comments.destroy', $comment) }}" method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline ml-1">Удалить</button>
                                </form>
                            @endcan
                        </li>
                    @endforeach
                </ul>

                {{-- Форма добавления комментария для авторизованных --}}
                @auth
                    <form action="{{ route('comments.store') }}" method="POST" class="mt-2">
                        @csrf
                        <input type="hidden" name="article_id" value="{{ $article->id }}">
                        <input type="text" name="content" placeholder="Ваш комментарий" class="border rounded px-2 py-1 w-2/3" required>
                        <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600">Добавить</button>
                    </form>
                @endauth
            </div>
        </li>
    @endforeach
</ul>

<div class="mt-4">
    {{ $articles->links() }}
</div>
@endsection
