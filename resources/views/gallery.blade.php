@extends('layouts.app')

@section('content')
    <h1>{{ $item['title'] }}</h1>

    <img src="{{ $item['full_image'] }}" alt="{{ $item['title'] }}" width="500">

    <p><a href="{{ route('home') }}">Назад</a></p>
@endsection
