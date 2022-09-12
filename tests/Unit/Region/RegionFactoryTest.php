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
        $this->assertNotEmpty($region->environment_type);
        $this->assertEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_parent() : void
    {
        $region = Region::factory()->withParentRegion()->make();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->name);
        $this->assertNotEmpty($region->environment_type);
        $this->assertNotEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_values() : void
    {
        $regionName = 'Halcyon Forests';
        $environmentType = 'Forest';
        $parentRegion = 'Halcyon';

        $region = Region::factory()->make([
            'name'             => $regionName,
            'environment_type' => $environmentType,
            'parent_region'    => $parentRegion,
        ]);

        $this->assertEquals(
            [
                $region->name,
                $region->environment_type,
                $region->parent_region,
            ],
            [
                $regionName,
                $environmentType,
                $parentRegion,
            ]
        );
    }

    public function test_the_factory_creates_a_region_without_parent_region() : void
    {
        $regionName = 'Halcyon Forests';
        $environmentType = 'Forest';

        $region = Region::factory()->create([
            'name'             => $regionName,
            'environment_type' => $environmentType,
        ]);

        $this->assertNotEmpty($region);
        $this->assertEquals([$region->name, $region->environment_type], [$regionName, $environmentType]);
        $this->assertEmpty($region->parent_region);
    }
}
