<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Tests\TestCase;

class ShowRegionControllerTest extends TestCase
{
    public function test_it_returns_a_region() : void
    {
        $region = Region::factory()->create();
        $this->json('get', 'api/region/'.$region->getKey())->assertSuccessful();
    }
}
