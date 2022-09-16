<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_a_region() : void
    {
        $region = Region::factory()->create();

        $this->json('DELETE', 'api/region/' . $region->getKey());

        $this->assertDatabaseMissing('regions', $region->toArray());
    }

}
