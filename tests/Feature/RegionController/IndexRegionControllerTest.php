<?php

namespace Tests\Feature\RegionController;

use Tests\TestCase;

class IndexRegionControllerTest extends TestCase
{
    public function test_it_returns_all_regions() : void
    {
        $this->json('GET', 'api/region')
            ->assertSuccessful()
            ->assertJson([[
                'region' => 'Test Region',
                'environment_type' => 'Forest',
            ]]);
    }
}
