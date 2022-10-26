<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncounterRequest;
use App\Http\Requests\UpdateEncounterRequest;
use App\Http\Resources\EncounterResource;
use App\Models\Encounter;
use App\Models\EncounterEnemy;
use App\Models\EncounterRegion;
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
                EncounterRegion::create([
                    'encounter_id' => $createdEncounter->getKey(),
                    'region_id'    => $region['id'],
                ]);
            }

            $enemies = $request->get('enemies');
            foreach ($enemies as $enemy) {
                EncounterEnemy::create([
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
        try {
            // Update the encounter values
            $encounter->update($request->all(['name', 'description', 'difficulty']));

            // Update region relations
            $regions = $request->get('regions');
            $encounter->regions()->sync($regions);

            // Update enemy relations
            $enemies = $request->get('enemies');
            $encounter->enemies()->sync($enemies);

            return Response($encounter, 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage());
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function destroy(Encounter $encounter) : Response
    {
        return new Response('Empty route');
    }
}
