<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncounterRequest;
use App\Http\Requests\UpdateEncounterRequest;
use App\Http\Resources\EncounterResource;
use App\Models\Encounter;
use App\Models\EncounterEnemies;
use App\Models\EncounterRegions;
use Exception;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class EncounterController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return EncounterResource::collection(Encounter::all());
    }

    public function store(StoreEncounterRequest $request) : Response|string
    {
        try {
            $encounter = $request->all(['name', 'description', 'difficulty']);

            $createdEncounter = Encounter::create($encounter);
            $regions = $request->get('regions');
            foreach ($regions as $region) {
                EncounterRegions::create([
                    'encounter_id' => $createdEncounter->getKey(),
                    'region_id'    => $region['id'],
                ]);
            }

            $enemies = $request->get('enemies');
            foreach ($enemies as $enemy) {
                EncounterEnemies::create([
                    'encounter_id' => $createdEncounter->getKey(),
                    'enemy_id'     => $enemy['id'],
                    'quantity'     => 1,
                ]);
            }

            return Response('Enemy stored successfully', 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage());
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function create() : Response
    {
        return new Response('Empty route');
    }

    public function show(Encounter $encounter) : EncounterResource
    {
        return EncounterResource::make($encounter);
    }

    public function edit(Encounter $encounter) : Response
    {
        return new Response('Empty route');
    }

    public function update(UpdateEncounterRequest $request, Encounter $encounter) : Response
    {
        return new Response('Empty route');
    }

    public function destroy(Encounter $encounter) : Response
    {
        return new Response('Empty route');
    }
}
