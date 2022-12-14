<?php

namespace Tests\Feature\RegionResourceController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyRegionResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_a_region() : void
    {
        $region = Region::factory()->create();

        $this->assertDatabaseHas('regions', $region->toArray());

        $this->json('DELETE', 'api/region/' . $region->getKey());

        $this->assertDatabaseMissing('regions', $region->toArray());
    }

    public function test_it_returns_405_without_an_id() : void
    {
        $this->json('DELETE', 'api/region/')->assertStatus(405);
    }

}
