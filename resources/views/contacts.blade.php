@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
<h2 class="text-2xl font-bold mb-4">Контакты</h2>

<ul class="space-y-2">
    @foreach($contacts as $contact)
        <li class="p-2 bg-gray-100 rounded shadow">
            <strong>{{ $contact['name'] }}</strong>: {{ $contact['email'] }}
        </li>
    @endforeach
</ul>
@endsection
