<?php

namespace Tests\Feature\RegionController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_region_with_name_and_environment_type() : void
    {
        // prepare the parameters for the region to be created
        $regionName = 'Store Test';
        $regionType = 'Forest';

        // send a request to create a region with a nane and environment type
        $response = $this->json('POST', 'api/region', [
            'name'             => $regionName,
            'environment_type' => $regionType,
        ]);

        // assert the request was successful
        $response->assertSuccessful();
        // assert the region was added to the database
        $this->assertDatabaseHas('Regions', [
            'name'             => $regionName,
            'environment_type' => $regionType,
        ]);
    }

    public function test_it_stores_a_region_with_name_and_environment_type_and_parent_region() : void
    {
        // prepare the parameters for the region to be created
        $regionName = 'Halcyon Forest';
        $regionType = 'Forest';
        $regionParentName = 'Northern Forests';

        // send a request to create a region with a nane and environment type
        $response = $this->json('POST', 'api/region', [
            'name'             => $regionName,
            'environment_type' => $regionType,
            'parent_region'    => $regionParentName,
        ]);

        // assert the request was successful
        $response->assertSuccessful();
        // assert the region was added to the database
        $this->assertDatabaseHas('regions', [
            'name'             => $regionName,
            'environment_type' => $regionType,
            'parent_region'    => $regionParentName,
        ]);
    }

}
