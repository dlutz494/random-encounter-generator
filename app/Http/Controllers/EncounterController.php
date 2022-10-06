<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEncounterRequest;
use App\Http\Requests\UpdateEncounterRequest;
use App\Http\Resources\EncounterResource;
use App\Models\Encounter;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class EncounterController extends Controller
{
    public function index() : AnonymousResourceCollection
    {
        return EncounterResource::collection(Encounter::all());
    }

    public function create() : Response
    {
        return new Response('Empty route');
    }

    public function store(StoreEncounterRequest $request) : Response
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
