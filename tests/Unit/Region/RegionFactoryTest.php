<?php

namespace Tests\Unit\Region;

use App\Models\Region;
use Tests\TestCase;

class RegionFactoryTest extends TestCase
{
    public function test_the_factory_creates_a_region(): void
    {
        $region = Region::factory()->create();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->region);
        $this->assertNotEmpty($region->environment_type);
        $this->assertEmpty($region->parent_region);
    }

    public function test_the_factory_creates_a_region_with_values(): void
    {
        $regionName = 'Halcyon Forests';
        $environmentType = 'Forest';
        $parentRegion = 'Halcyon';

        $region = Region::factory()->create([
            'region' => $regionName,
            'environment_type' => $environmentType,
            'parent_region' => $parentRegion,
        ]);

        $this->assertEquals(
            [$region->region, $region->environment_type, $region->parent_region],
            [$regionName, $environmentType, $parentRegion]
        );
    }

    public function test_the_factory_creates_a_region_without_parent_region(): void
    {
        $regionName = 'Halcyon Forests';
        $environmentType = 'Forest';

        $region = Region::factory()->create([
            'region' => $regionName,
            'environment_type' => $environmentType,
        ]);

        $this->assertNotEmpty($region);
        $this->assertEquals([$region->region, $region->environment_type], [$regionName, $environmentType]);
        $this->assertEmpty($region->parent_region);
    }
}
