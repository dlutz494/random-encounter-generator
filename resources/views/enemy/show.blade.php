<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Enemy Show</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>
    <body class="antialiased">
        <a href="/">Home</a>
        <h1>Show</h1>
        <p>ID: {{ $enemy->id }}</p>
        <p>Name: {{ $enemy->name }}</p>
        <p>Statblock: <a href="{{ $enemy->statblock }}" target="_blank">{{ $enemy->statblock }}</a></p>
        <p>Challenge Rating: {{ $enemy->challenge_rating }}</p>
        <br>
        <a href="/enemy/{{ $enemy->getKey() }}/edit">Edit</a>
        <form action="/enemy/{{ $enemy->getKey() }}/delete" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
        </form>
    </body>
</html>
