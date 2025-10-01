@extends('layouts.app')

@section('content')
<h1>Регистрация</h1>

@if(session('success'))
    <p style="color: green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('register.store') }}">
    @csrf
    <input type="text" name="name" placeholder="Имя" value="{{ old('name') }}">
    @error('name')<p style="color:red">{{ $message }}</p>@enderror

    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    @error('email')<p style="color:red">{{ $message }}</p>@enderror

    <input type="password" name="password" placeholder="Пароль">
    @error('password')<p style="color:red">{{ $message }}</p>@enderror

    <input type="password" name="password_confirmation" placeholder="Подтверждение пароля">

    <button type="submit">Зарегистрироваться</button>
</form>
@endsection
