<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class IndexRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_all_regions() : void
    {
        Region::factory()->create();

        $this->json('GET', 'api/region')
            ->assertSuccessful()
            ->assertJson([[
                'name' => 'Test Region',
                'environment_type' => 'Forest',
            ]]);
    }
}
