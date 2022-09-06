<?php

namespace Tests\Feature\RegionController;

use Tests\TestCase;

class IndexRegionControllerTest extends TestCase
{
    public function test_it_returns_all_regions() : void
    {
        $this->json('get', 'api/regions')->assertSuccessful();
    }
}
