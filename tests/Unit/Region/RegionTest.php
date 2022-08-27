<?php

namespace Tests\Unit\Region;

use App\Models\Region;
use Tests\TestCase;

class RegionTest extends TestCase
{
    public function test_the_factory_creates_a_region_with_no_values_given(): void
    {
        $region = Region::factory()->create();

        $this->assertNotEmpty($region);
        $this->assertNotEmpty($region->region);
        $this->assertNotEmpty($region->environment_type);
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
    }
}
