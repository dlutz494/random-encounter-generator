<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnemyRequest;
use App\Http\Requests\UpdateEnemyRequest;
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

    public function store(StoreEnemyRequest $request) : Response
    {
        try {
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

    public function update(UpdateEnemyRequest $request, Enemy $enemy) : Response
    {
        try {
            $enemy->update($request->all());

            return Response($enemy, 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage());
        } catch (Exception $e) {
            return Response('An unknown error occurred', 404);
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
