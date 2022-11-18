<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Enemy Edit</title>

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
        <h1>Edit</h1>
        <form method="POST" action="/enemy/{{ $enemy->getKey() }}/update">
            @csrf
            @method('PATCH')
            <label for="name">Name: </label>
            <input id="name" name="name" type="text" value="{{ $enemy->name }}"><br>
            <label for="statblock">Statblock: </label>
            <input id="statblock" name="statblock" type="text" value="{{ $enemy->statblock }}"><br>
            <label for="challenge_rating">Challenge Rating: </label>
            <input id="challenge_rating" name="challenge_rating" type="text" value="{{ $enemy->challenge_rating }}"><br>
            <br>
            <input type="submit">
        </form>
    </body>
</html>
