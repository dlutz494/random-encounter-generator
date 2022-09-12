<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_a_region() : void
    {
        $regionName = 'A Region';
        $regionType = 'Desert';

        $region = Region::factory()->create([
            'name'             => $regionName,
            'environment_type' => $regionType,
        ]);

        $this->json('GET', 'api/region/' . $region->getKey())
            ->assertSuccessful()
            ->assertJson([

            ]);
    }
}
