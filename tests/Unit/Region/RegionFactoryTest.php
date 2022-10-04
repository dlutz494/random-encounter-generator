<?php

namespace Tests\Unit\Region;

use App\Models\Environment;
use App\Models\Region;
use Tests\TestCase;

class RegionFactoryTest extends TestCase
{
    public function test_the_factory_creates_a_region() : void
    {
        $region = Region::factory()->create();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->name);
        $this->assertNotEmpty($region->environment);
        $this->assertEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_parent_region() : void
    {
        $region = Region::factory()->withParentRegion()->create();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->name);
        $this->assertNotEmpty($region->environment);
        $this->assertNotEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_values() : void
    {
        $regionName = 'Region-' . uniqid();
        $environment = Environment::factory()->create();
        $parentRegion = Region::factory()->create();

        $region = Region::factory()->create([
            'name'          => $regionName,
            'environment'   => $environment->getKey(),
            'parent_region' => $parentRegion->getKey(),
        ]);

        $this->assertEquals(
            [
                $region->name,
                $region->environment,
                $region->parent_region,
            ],
            [
                $regionName,
                $environment->getKey(),
                $parentRegion->getKey(),
            ]
        );
    }

    public function test_the_factory_creates_a_region_without_parent_region() : void
    {
        $regionName = 'Region-' . uniqid();
        $environment = Environment::factory()->create();

        $region = Region::factory()->create([
            'name'        => $regionName,
            'environment' => $environment,
        ]);

        $this->assertNotEmpty($region);
        $this->assertEquals(
            [
                $region->name,
                $region->environment,
            ],
            [
                $regionName,
                $environment->getKey(),
            ]
        );
        $this->assertEmpty($region->parent_region);
    }
}
