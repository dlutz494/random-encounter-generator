<?php

namespace Tests\Feature\RegionController;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class StoreRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_a_region_with_name_and_environment_type() : void
    {
        // prepare the parameters for the region to be created
        $regionName = 'Halcyon Forest';
        $regionType = 'Forest';
        // send a request to create a region with a nane and environment type
        $this->json('POST', 'api/regions', [
            'name'             => $regionName,
            'environment_type' => $regionType,
        ])->assertSuccessful();
    }
}
