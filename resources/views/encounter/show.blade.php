<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Encounter Show</title>

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
        <p>ID: {{ $encounter->id }}</p>
        <p>Name: {{ $encounter->name }}</p><br>
        <a href="/encounter/{{ $encounter->getKey() }}/edit">Edit</a>
        <form action="/encounter/{{ $encounter->getKey() }}/delete" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
        </form>
    </body>
</html>
