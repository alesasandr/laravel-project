@extends('layouts.app')

@section('content')
<h1 class="text-3xl font-bold mb-4">Главная страница</h1>

<table class="table-auto border-collapse border border-gray-300 w-full">
    <thead>
        <tr>
            <th class="border px-4 py-2">Название</th>
            <th class="border px-4 py-2">Описание</th>
            <th class="border px-4 py-2">Картинка</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
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
