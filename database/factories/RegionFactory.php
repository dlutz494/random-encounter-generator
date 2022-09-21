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
            'name'        => 'Test Region',
            'environment' => Environment::factory()->create(),
        ];
    }

    public function withParentRegion() : self
    {
        return $this->state(function () {
            return [
                'parent_region' => Region::factory()->create([
                    'name' => 'Test Parent Region',
                ])->getKey(),
            ];
        });
    }

    public function withUniqueName() : self
    {
        return $this->state(function () {
            return [
                'name' => $this->faker->unique()->city,
            ];
        });
    }

    public function withUniqueParentRegion() : self
    {
        return $this->state(function () {
            return [
                'parent_region' => Region::factory()->create([
                    'name' => $this->faker->unique()->city,
                ])->getKey(),
            ];
        });
    }
}
