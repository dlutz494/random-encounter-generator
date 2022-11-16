@php use App\Models\Environment; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Region Index</title>

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
        <a href="region/create">New Region</a>
        <br>
        @foreach($regions as $region)
            <a href="region/{{ $region->getKey() }}">View</a>
            <p>ID: {{ $region->getKey() }}</p>
            <p>Name: {{ $region->name }}</p>
            <p>Environment: {{ Environment::find($region->environment)->name }}</p>
            <br>
        @endforeach
    </body>
</html>
