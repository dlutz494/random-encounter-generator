<?php

namespace Database\Factories;

use App\Models\EnvironmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EnvironmentType>
 */
class EnvironmentTypeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'environment_type' => 'Test Environment',
        ];
    }
}
