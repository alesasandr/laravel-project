@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<h1>Контакты</h1>
<ul>
    @foreach($contacts as $contact)
        <li>{{ $contact['name'] }} — {{ $contact['email'] }}</li>
    @endforeach
</ul>
@endsection
