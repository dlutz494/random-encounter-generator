<?php

namespace Tests\Feature\RegionController;

use Tests\TestCase;

class StoreRegionControllerTest extends TestCase
{
    public function test_it_returns_a_region_with_name_and_environment() : void
    {
        // prepare the parameters for the region to be created
        $regionName = 'Halcyon Forest';
        $regionType = 'Forest';
        // send a request to create a region with a nane and environment type
        $this->json('post', 'api/regions', [
            'name' => $regionName,
            'environment_type' => $regionType,
        ])->assertSuccessful();
    }
}
