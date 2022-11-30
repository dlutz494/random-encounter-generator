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

class EncounterResourceController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return EncounterResource::collection(Encounter::all());
    }

    public function store(StoreEncounterRequest $request) : Response|string
    {
        try {
            $encounter = new Encounter();
            $encounter->name = $request->get('name');
            $encounter->description = $request->get('description');
            $encounter->difficulty = $request->get('difficulty');
            $encounter->save();

            $regions = $request->get('regions');
            foreach ($regions as $region) {
                $encounter->regions()->attach($region['id']);
            }
            $enemies = $request->get('enemies');
            foreach ($enemies as $enemy) {
                $encounter->enemies()->attach($enemy['id']);
            }

            $encounter->save();
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
        return new Response($encounter, 200);
    }

    public function update(UpdateEncounterRequest $request, Encounter $encounter) : Response
    {
        try {
            $encounter->update($request->input());

            $encounter->regions()->sync($request->get('regions'));

            $encounter->enemies()->sync($request->get('enemies'));

            return Response($encounter, 200);
        } catch (ValidationException $e) {
            return Response($e->getMessage());
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }

    public function destroy(Encounter $encounter) : Response
    {
        try {
            $encounter->delete();

            return Response('Encounter successfully deleted', 200);
        } catch (Exception $e) {
            return Response('An error occurred', 404);
        }
    }
}
