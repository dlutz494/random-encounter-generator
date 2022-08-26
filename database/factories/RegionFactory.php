<?php

namespace Database\Factories;

use App\Models\EnvironmentType;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Region>
 */
class RegionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'region' => 'Test Region',
            'environment_type' => EnvironmentType::factory()->create()->getKey(),
        ];
    }
}
