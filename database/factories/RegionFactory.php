<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    public function definition() : array
    {
        return [
            'region' => 'Test Region',
            'environment_type' => 'Forest',
        ];
    }
}
