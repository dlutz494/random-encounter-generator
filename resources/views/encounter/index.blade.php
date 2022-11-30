<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Encounter Index</title>

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
        <a href="encounter/create">New Encounter</a>
        <br>
        @foreach($encounters as $encounter)
            <a href="encounter/{{ $encounter->getKey() }}">View</a>
            <p>ID: {{ $encounter->getKey() }}</p>
            <p>Name: {{ $encounter->name }}</p>
            <p>Description: {{ $encounter->description }}</p>
            <p>Difficulty: {{ $encounter->difficulty }}</p>
            <p>Regions:</p>
            <ul>
                @foreach($encounter->regions as $region)
                    <li>
                        <ul>
                            <li>Name: {{ $region->name }}</li>
                            <li>Environment: {{ $region->environment }}</li>
                            <li>Parent: {{ $region->parent_ragion ?: 'N/A' }}</li>
                        </ul>
                    </li>
                @endforeach
            </ul>
            <p>Enemies:</p>
            <ul>
                @foreach($encounter->enemies as $enemy)
                    <li>
                        <ul>
                            <li>Name: {{ $enemy->name }}</li>
                            <li>Statblock: <a href="{{ $enemy->statblock }}" target="_blank">{{ $enemy->statblock }}</a></li>
                            <li>Challenge Rating: {{ $enemy->challenge_rating }}</li>
                            <li>Quantity: N/A</li>
                        </ul>
                    </li>
                    <br>
                @endforeach
            </ul>
        @endforeach
    </body>
</html>
