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

    public function withEnemy(Enemy $enemy) : EncounterEnemiesFactory
    {
        return $this->state(function () use ($enemy) {
            return [
                'enemy_id' => $enemy->getKey(),
            ];
        });
    }
}
