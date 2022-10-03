<?php

namespace Database\Factories;

use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class EncounterFactory extends Factory
{
    public function definition() : array
    {
        return [
            'name'        => 'Encounter-' . uniqid(),
            'description' => 'Test description',
            'difficulty'  => $this->faker->randomElement([
                'Trivial',
                'Easy',
                'Moderate',
                'Hard',
                'Deadly',
            ]),
        ];
    }

    public function withRegions(int $count = 1)
    {
        // Factory Regions then create as many records in the EncounterRegions table
//        return $this->state(function () use ($count) {
//            $regions = Region::factory($count)->create();
//
//            return [
//                'regions' => $regions,
//            ];
//        });
    }

    public function withEnemies(int $count = 1)
    {
        // Factory Enemies then create as many records in the EncounterEnemies table
//        return $this->state(function () use ($count) {
//            Enemy::factory($count)->create();
//        });
    }

}
