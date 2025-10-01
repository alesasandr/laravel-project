@extends('layouts.app')

@section('content')
    <h1>Главная страница</h1>

    <table border="1" cellpadding="10">
        <tr>
            <th>Название</th>
            <th>Превью</th>
        </tr>
        @foreach ($items as $index => $item)
            <tr>
                <td>{{ $item['title'] }}</td>
                <td>
                    <a href="{{ route('gallery', $index) }}">
                        <img src="{{ $item['preview_image'] }}" alt="{{ $item['title'] }}" width="100">
                    </a>
                </td>
            </tr>
        @endforeach
    </table>
@endsection
