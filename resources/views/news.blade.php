<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Новости</title>
</head>

<body>
    <header>
        <h1>Выбранный город: {{ $city }}</h1>
    </header>
    <main>
        <a href="{{ route('index' )}}">Main page</a><br><br>

        <h2>Новости</h2>
        <p>Lorem ipsum dolor sit amet.</p>
    </main>
</body>

</html>