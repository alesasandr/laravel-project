<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Мой сайт')</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-light p-3 mb-4">
        <nav>
            <a href="{{ route('home') }}" class="me-3">Главная</a>
            <a href="{{ route('about') }}" class="me-3">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>
        </nav>
    </header>

    <main class="container">
        @yield('content')
    </main>

    <footer class="bg-light p-3 mt-4 text-center">
        ФИО: Васько Александр | Группа: 231-322
    </footer>
</body>
</html>
