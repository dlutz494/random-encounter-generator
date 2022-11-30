<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Encounter Edit</title>

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
        <form method="POST" action="/encounter/{{ $encounter->getKey() }}/update">
            @csrf
            @method('PATCH')
            <label for="name">Name: </label>
            <input id="name" name="name" type="text" value="{{ $encounter->name }}"><br>
            <label for="description">Description: </label>
            <input id="name" name="description" type="text" value="{{ $encounter->description }}"><br>
            <label for="difficulty">Difficulty: </label>
            <input id="name" name="difficulty" type="text" value="{{ $encounter->difficulty }}"><br>
            <label for="regions">Region(s): </label>
            <select name="regions" id="regions">
                @foreach($encounter->regions as $region)
                    @if($region->getKey() == $encounter->regions->first()->getKey())
                        <option value="{{ $region->getKey() }}" selected>{{ $region->name }}</option>
                    @else
                        <option value="{{ $region->getKey() }}">{{ $region->name }}</option>
                    @endif
                @endforeach
            </select>
            <br>
            <label for="enemies">Enemies: </label>
            <select name="enemies" id="enemies">
                @foreach($encounter->enemies as $enemy)
                    @if($enemy->getKey() == $encounter->enemies->first()->getKey())
                        <option value="{{ $enemy->getKey() }}" selected>{{ $enemy->name }}</option>
                    @else
                        <option value="{{ $enemy->getKey() }}">{{ $enemy->name }}</option>
                    @endif
                @endforeach
            </select>
            <input type="submit">
        </form>
    </body>
</html>
