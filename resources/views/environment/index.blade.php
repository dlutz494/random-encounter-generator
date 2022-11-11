<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Environment Index</title>

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
        <h1>Index</h1>
        <a href="environment/create">New Environment</a>
        <br>
        @foreach($environments as $environment)
            <a href="environment/{{ $environment->getKey() }}">View</a>
            <p>ID: {{ $environment->getKey() }}</p>
            <p>Name: {{ $environment->name }}</p>
            <br>
        @endforeach
    </body>
</html>
