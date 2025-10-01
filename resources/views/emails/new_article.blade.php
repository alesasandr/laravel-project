<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>
    <h2>Новая статья добавлена</h2>
    <p>Заголовок: <strong>{{ $article->title }}</strong></p>
    <p>Содержание:</p>
    <p>{{ $article->content }}</p>

    <p>Посмотреть статью: <a href="{{ route('articles.show', $article) }}">Перейти</a></p>
</body>
</html>
