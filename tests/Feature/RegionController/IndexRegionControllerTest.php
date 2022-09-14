<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_region() : void
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

    public function test_it_returns_multiple_regions() : void
    {
        Region::factory(3)->create();

        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => 'Test Region',
                'environment_type' => 'Forest',
            ],
            [
                'name'             => 'Test Region',
                'environment_type' => 'Forest',
            ],
            [
                'name'             => 'Test Region',
                'environment_type' => 'Forest',
            ],
        ]);
    }

    public function test_it_returns_no_regions() : void
    {
        $response = $this->json('GET', 'api/region');

        $response->assertSuccessful();
        $response->assertJson([]);
    }
}
