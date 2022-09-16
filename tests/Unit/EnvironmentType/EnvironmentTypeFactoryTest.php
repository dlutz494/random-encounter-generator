<?php

namespace Tests\Unit\EnvironmentType;

use App\Models\Environment;
use Tests\TestCase;

class EnvironmentTypeFactoryTest extends TestCase
{
    public function test_the_factory_creates_an_environment_type() : void
    {
        $environmentType = Environment::factory()->create();

        $this->assertNotEmpty($environmentType);
        $this->assertNotEmpty($environmentType->name);
    }

    public function test_the_factory_creates_an_environment_type_with_values() : void
    {
        $name = 'Forest';

        $environmentType = Environment::factory()->create([
            'name' => $name,
        ]);

        $this->assertEquals($name, $environmentType->name);
    }
}
