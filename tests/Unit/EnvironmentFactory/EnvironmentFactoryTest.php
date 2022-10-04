<?php

namespace Tests\Unit\EnvironmentFactory;

use App\Models\Environment;
use Tests\TestCase;

class EnvironmentFactoryTest extends TestCase
{
    public function test_the_factory_creates_an_environment_type() : void
    {
        $environment = Environment::factory()->create();

        $this->assertNotEmpty($environment);
        $this->assertNotEmpty($environment->name);
    }

    public function test_the_factory_creates_an_environment_type_with_values() : void
    {
        $name = 'Forest';

        $environment = Environment::factory()->create([
            'name' => $name,
        ]);

        $this->assertEquals($name, $environment->name);
    }
}
