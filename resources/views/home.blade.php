@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-4">Главная страница</h1>

{{-- Форма авторизации, если пользователь не вошёл --}}
@guest
    <div class="mb-6 p-4 border rounded bg-gray-100 w-full max-w-md">
        <h2 class="text-xl font-semibold mb-2">Вход</h2>

        @if($errors->any())
            <p class="text-red-500 mb-2">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login.store') }}">
            @csrf
            <div class="mb-2">
                <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full p-2 border rounded">
            </div>
            <div class="mb-2">
                <input type="password" name="password" placeholder="Пароль" class="w-full p-2 border rounded">
            </div>
            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Войти</button>
        </form>
    </div>
@endguest

{{-- Таблица данных из JSON --}}
<table class="table-auto border-collapse border border-gray-300 w-full">
    <thead>
        <tr>
            <th class="border px-4 py-2">Название</th>
            <th class="border px-4 py-2">Описание</th>
            <th class="border px-4 py-2">Картинка</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $item)
            <tr>
                <td class="border px-4 py-2">{{ $item['title'] ?? 'Без названия' }}</td>
                <td class="border px-4 py-2">{{ $item['description'] ?? 'Нет описания' }}</td>
                <td class="border px-4 py-2">
                    @if(!empty($item['preview_image']))
                        <img src="{{ asset($item['preview_image']) }}" alt="{{ $item['title'] }}" style="width: 100px;">
                    @else
                        Нет изображения
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
