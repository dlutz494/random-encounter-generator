<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RegionFactory extends Factory
{
    public function definition() : array
    {
        return [
            'name'        => 'Test Region',
            'environment' => 'Forest',
        ];
    }

    public function withParentRegion() : self
    {
        return $this->state(function (array $attributes) {
            return [
                'parent_region' => 'Test Parent Region',
            ];
        });
    }
}
