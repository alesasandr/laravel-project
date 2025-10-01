@extends('layouts.app')

@section('content')
    <h1>Новости</h1>
    <ul>
        @foreach($articles as $article)
            <li>
                <strong>{{ $article->title }}</strong><br>
                {{ $article->content }}<br>
                <em>{{ $article->created_at->format('d.m.Y H:i') }}</em>
            </li>
        @endforeach
    </ul>
@endsection
