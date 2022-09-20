<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnemyResource;
use App\Models\Enemy;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class EnemyController extends Controller
{
    public function index() : Collection
    {
        return Enemy::all();
    }

    public function store(Request $request) : Response
    {
        try {
            $request->validate([
                'name'             => 'required|unique:enemies|string',
                'statblock'        => 'required|string',
                'challenge_rating' => 'required|string',
            ]);

            Enemy::create($request->all());

            return Response('Enemy stored successfully', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function create() : Response
    {
        return Response('Empty Route', 200);
    }

    public function show(Enemy $enemy) : EnemyResource
    {
        return EnemyResource::make($enemy);
    }

    public function edit(Enemy $enemy) : Response
    {
        return Response($enemy, 200);
    }

    public function update(Request $request, Enemy $enemy) : Response
    {
        try {
            $request->validate([
                'name'             => 'string|unique:enemies|nullable',
                'statblock'        => 'string|nullable',
                'challenge_rating' => 'string|nullable',
            ]);

            $enemy->update($request->all());

            return Response($enemy, 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage(), 400);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function destroy(Enemy $enemy) : Response
    {
        try {
            Enemy::destroy($enemy->getKey());

            return Response('Enemy deleted', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }
}
