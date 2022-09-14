<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_all_regions() : void
    {
        Region::factory()->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => 'Test Region',
                'environment_type' => 'Forest',
            ],
        ]);
    }
}
