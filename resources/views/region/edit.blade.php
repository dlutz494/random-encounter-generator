@php use App\Models\Environment; @endphp
    <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Region Edit</title>

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
        <form method="POST" action="/region/{{ $region->getKey() }}/update">
            @csrf
            @method('PATCH')
            <label for="name">Name: </label>
            <input id="name" name="name" type="text" value="{{ $region->name }}">
            <br>
            <label for="environment">Environment: </label>
            <select id="environment" name="environment">
                @foreach(Environment::all() as $environment)
                    @if($environment->getKey() == $region->environment)
                        <option value="{{ $environment->getKey() }}" selected>{{ $environment->name }}</option>
                    @else
                        <option value="{{ $environment->getKey() }}">{{ $environment->name }}</option>
                    @endif
                @endforeach
            </select>
            <br>
            <input type="submit">
        </form>
    </body>
</html>
