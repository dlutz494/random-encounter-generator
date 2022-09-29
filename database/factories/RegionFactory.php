<?php

namespace Database\Factories;

use App\Models\Environment;
use App\Models\Region;
use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    public function definition() : array
    {
        return [
            'name'        => $this->faker->unique()->city,
            'environment' => Environment::factory()->create(),
        ];
    }

    public function withParentRegion() : self
    {
        return $this->state(function () {
            return [
                'parent_region' => Region::factory()->create()->getKey(),
            ];
        });
    }
}
