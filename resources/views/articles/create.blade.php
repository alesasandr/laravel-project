@extends('layouts.app')

@section('title', 'Создать новость')

@section('content')
<h2 class="text-2xl font-bold mb-4">Создать новость</h2>

<form method="POST" action="{{ route('articles.store') }}" class="space-y-4 bg-white p-4 shadow rounded">
    @csrf
    <div>
        <label class="block mb-1">Заголовок:</label>
        <input type="text" name="title" value="{{ old('title') }}" class="w-full border px-2 py-1 rounded">
        @error('title') <div class="text-red-500">{{ $message }}</div> @enderror
    </div>

    <div>
        <label class="block mb-1">Содержание:</label>
        <textarea name="content" class="w-full border px-2 py-1 rounded">{{ old('content') }}</textarea>
        @error('content') <div class="text-red-500">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Создать</button>
</form>
@endsection
