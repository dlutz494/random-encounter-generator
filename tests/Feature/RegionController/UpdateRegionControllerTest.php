<?php

namespace Tests\Feature\RegionController;

use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_a_region() : void
    {
        $region = Region::factory()->create();
        $payload = [
            'name'             => 'Update Test',
            'environment_type' => 'Urban',
            'parent_region'    => 'Parent Update Test',
        ];

        $this->json('PUT', 'api/region/' . $region->getKey(), $payload);

        $this->assertDatabaseHas('Regions', $payload);
    }

    /**
     * @dataProvider ProvidesValidPayload
     */
    public function test_it_returns_success_with_valid_payloads($payload) : void
    {
        $region = Region::factory()->create();

        $response = $this->json('PUT', 'api/region/' . $region->getKey(), [$payload]);

        $response->assertSuccessful();
    }

    public function ProvidesValidPayload() : array
    {
        $regionName = 'Store Region';
        $regionType = 'Desert';
        $regionParent = 'Parent Store Region';

        return [
            'Name only'                          => [
                'name' => $regionName,
            ],
            'Environment type only'              => [
                'environment_type' => $regionType,
            ],
            'Parent region only'                 => [
                'parent_region' => $regionParent,
            ],
            'Name and environment type'          => [
                'name'             => $regionName,
                'environment_type' => $regionType,
            ],
            'Name and parent region'             => [
                'name'          => $regionName,
                'parent_region' => $regionParent,
            ],
            'Environment type and parent region' => [
                'environment_type' => $regionType,
                'parent_region'    => $regionParent,
            ],
            'All fields'                         => [
                'name'             => $regionName,
                'environment_type' => $regionType,
                'parent_region'    => $regionParent,
            ],
        ];
    }

}
