<?php

namespace App\Http\Controllers;

use App\Http\Resources\EnemyResource;
use App\Models\Enemy;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnemyController extends Controller
{
    public function index() : Collection
    {
        return Enemy::all();
    }

    public function create() : Response
    {
        return Response('Empty Route', 200);
    }

    public function store(Request $request) : Response
    {
        return Response('Enemy stored successfully');
    }

    public function show(Enemy $enemy) : EnemyResource
    {
        return EnemyResource::make(Enemy::findOrFail($enemy->getKey()));
    }

    public function edit(Enemy $enemy) : Response
    {
        return Response($enemy, 200);
    }

    public function update(Request $request, Enemy $oldEnemy) : Response
    {
        try {
            $enemy = Enemy::findOrFail($oldEnemy->getKey());
            $enemy->update($request->all());

            return Response($enemy, 200);
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
