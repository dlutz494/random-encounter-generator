<?php

namespace Tests\Unit\EnvironmentType;

use App\Models\EnvironmentType;
use Tests\TestCase;

class EnvironmentTypeFactoryTest extends TestCase
{
    public function test_the_factory_creates_an_environment_type(): void
    {
        $environmentType = EnvironmentType::factory()->create();

        $this->assertNotEmpty($environmentType);
        $this->assertNotEmpty($environmentType->name);
    }

    public function test_the_factory_creates_an_environment_type_with_values(): void
    {
        $name = 'Forest';

        $environmentType = EnvironmentType::factory()->create([
            'name' => $name,
        ]);

        $this->assertEquals($name, $environmentType->name);
    }
}
