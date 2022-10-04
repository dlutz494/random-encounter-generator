<?php

namespace Database\Factories;

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

}
