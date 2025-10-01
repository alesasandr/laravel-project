<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Site</title>
</head>
<body>
    <header>
        <nav>
            <a href="{{ route('home') }}">Главная</a> |
            <a href="{{ route('about') }}">О нас</a> |
            <a href="{{ route('contacts') }}">Контакты</a> |
            <a href="{{ route('signin.create') }}">Регистрация</a>
        </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>Васько Александр Игоревич 231-322</p>
    </footer>
</body>
</html>
