<?php

namespace App\Traits;

use App\Http\Requests\StoreEncounterRequest;
use App\Models\Encounter;

trait EncounterOperations
{
    public function storeEncounter(StoreEncounterRequest $request) : void
    {
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
    }
}
