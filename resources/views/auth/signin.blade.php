@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Регистрация</h2>

    <form method="POST" action="{{ route('signin.registration') }}">
        @csrf

        <div>
            <label for="name">Имя:</label>
            <input type="text" name="name" required>
        </div>

        <div>
            <label for="email">Email:</label>
            <input type="email" name="email" required>
        </div>

        <div>
            <label for="password">Пароль:</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>
</div>
@endsection
