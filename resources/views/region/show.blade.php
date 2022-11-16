<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Region Show</title>

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
        <p>ID: {{ $region->id }}</p>
        <p>Name: {{ $region->name }}</p>
        <br>
        <a href="/region/{{ $region->getKey() }}/edit">Edit</a>
        <form action="/region/{{ $region->getKey() }}/delete" method="POST">
            @csrf
            @method('DELETE')
            <input type="submit" value="Delete">
        </form>
    </body>
</html>
