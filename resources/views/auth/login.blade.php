@extends('layouts.app')

@section('content')
<h1>Вход</h1>

@if($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('login.store') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" value="{{ old('email') }}">
    <input type="password" name="password" placeholder="Пароль">
    <button type="submit">Войти</button>
</form>
@endsection
