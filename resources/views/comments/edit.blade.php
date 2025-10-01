@extends('layouts.app')

@section('title', 'Редактировать комментарий')

@section('content')
<div class="max-w-xl mx-auto mt-6">
    <h2 class="text-2xl font-bold mb-4">Редактировать комментарий</h2>

    <form method="POST" action="{{ route('comments.update', $comment) }}" class="space-y-4 bg-white p-4 shadow rounded">
        @csrf
        @method('PUT')

        <textarea name="content" class="w-full border px-2 py-1 rounded" rows="4" required>{{ old('content', $comment->content) }}</textarea>
        @error('content')
            <div class="text-red-500">{{ $message }}</div>
        @enderror

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Обновить</button>
    </form>
</div>
@endsection
