<?php

namespace Tests\Unit\Region;

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
        $environment = 'Forest';
        $parentRegion = 'Halcyon';

        $region = Region::factory()->make([
            'name'             => $regionName,
            'environment_type' => $environment,
            'parent_region'    => $parentRegion,
        ]);

        $this->assertEquals(
            [
                $region->name,
                $region->environment,
                $region->parent_region,
            ],
            [
                $regionName,
                $environment,
                $parentRegion,
            ]
        );
    }

    public function test_the_factory_creates_a_region_without_parent_region() : void
    {
        $regionName = 'Halcyon Forests';
        $environment = 'Forest';

        $region = Region::factory()->create([
            'name'        => $regionName,
            'environment' => $environment,
        ]);

        $this->assertNotEmpty($region);
        $this->assertEquals([$region->name, $region->environment], [$regionName, $environment]);
        $this->assertEmpty($region->parent_region);
    }
}
