<?php

namespace Database\Factories;

use App\Models\Encounter;
use App\Models\Enemy;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncounterEnemiesFactory extends Factory
{
    public function definition() : array
    {
        return [
            'encounter_id' => Encounter::factory()->create(),
            'enemy_id'     => Enemy::factory()->create(),
            'quantity'     => $this->faker->numberBetween(1, 10),
        ];
    }

    public function withEncounter(Encounter $encounter) : EncounterEnemiesFactory
    {
        return $this->state(function () use ($encounter) {
            return [
                'encounter_id' => $encounter->getKey(),
            ];
        });
    }

}
