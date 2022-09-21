<?php

namespace Tests\Unit\Region;

use App\Models\Environment;
use App\Models\Region;
use Tests\TestCase;

class RegionFactoryTest extends TestCase
{
    public function test_the_factory_creates_a_region() : void
    {
        $region = Region::factory()->make();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->name);
        $this->assertNotEmpty($region->environment);
        $this->assertEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_parent() : void
    {
        $region = Region::factory()->withParentRegion()->make();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->name);
        $this->assertNotEmpty($region->environment);
        $this->assertNotEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_values() : void
    {
        $regionName = 'Halcyon Forests';
        $environment = Environment::factory()->create();
        $parentRegion = Region::factory()->create();

        $region = Region::factory()->make([
            'name'          => $regionName,
            'environment_id'   => $environment->getKey(),
            'parent_region' => $parentRegion->getKey(),
        ]);

        $this->assertEquals(
            [
                $region->name,
                $region->environment_id,
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
        $regionName = 'Halcyon Forests';
        $environment = Environment::factory()->create();

        $region = Region::factory()->create([
            'name'        => $regionName,
            'environment' => $environment,
        ]);

        $this->assertNotEmpty($region);
        $this->assertEquals([$region->name, $region->environment], [$regionName, $environment->getKey()]);
        $this->assertEmpty($region->parent_region);
    }
}
