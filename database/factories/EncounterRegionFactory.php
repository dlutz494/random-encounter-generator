<?php

namespace Database\Factories;

use App\Models\Encounter;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncounterRegionFactory extends Factory
{
    public function definition() : array
    {
        return [
            'encounter_id' => Encounter::factory()->create(),
            'region_id'    => Region::factory()->create(),
        ];
    }

    public function withEncounter(Encounter $encounter) : EncounterRegionFactory
    {
        return $this->state(function () use ($encounter) {
            return [
                'encounter_id' => $encounter->getKey(),
            ];
        });
    }

    public function withRegion(Region $region) : EncounterRegionFactory
    {
        return $this->state(function () use ($region) {
            return [
                'region_id' => $region->getKey(),
            ];
        });
    }
}
