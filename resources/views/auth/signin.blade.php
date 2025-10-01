@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-2xl font-bold mb-4">Регистрация</h2>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('signin.registration') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-medium">Имя:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="border px-2 py-1 w-full">
        </div>

        <div>
            <label for="email" class="block font-medium">Email:</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}" required class="border px-2 py-1 w-full">
        </div>

        <div>
            <label for="password" class="block font-medium">Пароль:</label>
            <input type="password" name="password" id="password" required class="border px-2 py-1 w-full">
        </div>

        <div>
            <label for="password_confirmation" class="block font-medium">Подтверждение пароля:</label>
            <input type="password" name="password_confirmation" id="password_confirmation" required class="border px-2 py-1 w-full">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Зарегистрироваться</button>
    </form>
</div>
@endsection
