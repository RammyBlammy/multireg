<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная</title>
</head>

<body>
    <header>
        <h1>Выбранный город: {{ session('selected_city') }}</h1>
    </header>
    <main>
        <a href="{{ route('news', ['city' => session('selected_city') ?? 'def']) }}">News</a><br><br>
        <a href="{{ route('about', ['city' => session('selected_city') ?? 'def']) }}">About</a><br><br>

        <h2>Список городов</h2>
        <ul>
            @foreach($cities as $city)
            <li>
                <a href="{{ route('set.city', ['name' => $city->slug]) }}">
                    @if (session('selected_city') === $city->slug)
                    <strong>{{$city->name}}</strong>
                    @else
                    {{$city->name}}
                    @endif
                </a>
            </li>
            @endforeach
        </ul>
    </main>
</body>

</html>