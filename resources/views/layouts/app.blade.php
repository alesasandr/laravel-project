<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel Project')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-50 font-sans text-gray-800">
    <header class="bg-white shadow">
        <div class="container mx-auto flex justify-between items-center p-4">
            <h1 class="text-xl font-bold">Мой сайт на Laravel</h1>
            <nav class="space-x-4">

                <a href="{{ route('home') }}" class="text-blue-500 hover:underline">Главная</a>
                <a href="{{ route('about') }}" class="text-blue-500 hover:underline">О нас</a>
                <a href="{{ route('contacts') }}" class="text-blue-500 hover:underline">Контакты</a>
                <a href="{{ route('articles.index') }}" class="text-blue-500 hover:underline">Новости</a>

                @guest
                    <a href="{{ route('signin.create') }}" class="text-blue-500 hover:underline">Регистрация</a>
                    <a href="{{ route('login.create') }}" class="text-blue-500 hover:underline">Вход</a>
                @endguest

                @auth
                    {{-- Ссылка только для модератора на страницу проверки комментариев --}}
                    @if(auth()->user()->role && auth()->user()->role->name === 'moderator')
                        <a href="{{ route('comments.moderation') }}" class="text-purple-600 font-semibold hover:underline">
                            Модерация комментариев
                        </a>
                    @endif

                    @can('create', App\Models\Article::class)
                        <a href="{{ route('articles.create') }}" class="text-green-500 hover:underline">Создать новость</a>
                    @endcan

                    <form method="POST" action="{{ route('logout') }}" class="inline-block">
                        @csrf
                        <button type="submit" class="text-red-500 hover:underline">Выйти</button>
                    </form>
                @endauth
            </nav>
        </div>
    </header>

    <main class="container mx-auto mt-6 p-4">
        @yield('content')
    </main>

    <footer class="bg-white mt-12 shadow py-4">
        <div class="container mx-auto text-center text-gray-500">
            Васько Александр 231-322
        </div>
    </footer>
</body>
</html>
