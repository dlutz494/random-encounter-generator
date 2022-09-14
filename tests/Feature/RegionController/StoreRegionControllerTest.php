<?php

namespace Tests\Feature\RegionController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_region_with_name_and_environment_type() : void
    {
        $regionName = 'Store Test';
        $regionType = 'Forest';

        $response = $this->json('POST', 'api/region', [
            'name'             => $regionName,
            'environment_type' => $regionType,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('Regions', [
            'name'             => $regionName,
            'environment_type' => $regionType,
        ]);
    }

    public function test_it_stores_a_region_with_name_and_environment_type_and_parent_region() : void
    {
        $regionName = 'Halcyon Forest';
        $regionType = 'Forest';
        $regionParentName = 'Northern Forests';

        $response = $this->json('POST', 'api/region', [
            'name'             => $regionName,
            'environment_type' => $regionType,
            'parent_region'    => $regionParentName,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('regions', [
            'name'             => $regionName,
            'environment_type' => $regionType,
            'parent_region'    => $regionParentName,
        ]);
    }

}
