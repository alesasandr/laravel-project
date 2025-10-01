@extends('layouts.app')

@section('title', 'Редактировать новость')

@section('content')
<h2 class="text-2xl font-bold mb-4">Редактировать новость</h2>

<form method="POST" action="{{ route('articles.update', $article) }}" class="space-y-4 bg-white p-4 shadow rounded">
    @csrf
    @method('PUT')

    <div>
        <label class="block mb-1">Заголовок:</label>
        <input type="text" name="title" value="{{ old('title', $article->title) }}" class="w-full border px-2 py-1 rounded">
        @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block mb-1">Содержание:</label>
        <textarea name="content" class="w-full border px-2 py-1 rounded">{{ old('content', $article->content) }}</textarea>
        @error('content') <div class="text-red-500">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Обновить</button>
</form>
@endsection
