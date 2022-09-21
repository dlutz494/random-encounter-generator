<?php

namespace Tests\Feature\RegionController;

use App\Models\Environment;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateRegionControllerTest extends TestCase
{
    use RefreshDatabase;

    protected Region $region;

    protected function setUp() : void
    {
        parent::setUp();

        $this->region = Region::factory()->create();
    }

    public function test_it_updates_a_region() : void
    {
        $payload = [
            'name'          => 'Update Test',
            'environment'   => Environment::factory()->create()->getKey(),
            'parent_region' => Region::factory()->withUniqueName()->create()->getKey(),
        ];

        $this->json('PUT', 'api/region/' . $this->region->getKey(), $payload);

        $this->assertDatabaseHas('regions', $payload);
    }

    /**
     * @dataProvider ProvidesValidPayload
     */
    public function test_it_returns_success_with_valid_payloads($payload) : void
    {
        $response = $this->json('PUT', 'api/region/' . $this->region->getKey(), [$payload]);

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
            'Environment only'              => [
                'environment' => $regionType,
            ],
            'Parent region only'                 => [
                'parent_region' => $regionParent,
            ],
            'Name and environment'          => [
                'name'        => $regionName,
                'environment' => $regionType,
            ],
            'Name and parent region'             => [
                'name'          => $regionName,
                'parent_region' => $regionParent,
            ],
            'Environment and parent region' => [
                'environment'   => $regionType,
                'parent_region' => $regionParent,
            ],
            'All fields'                         => [
                'name'          => $regionName,
                'environment'   => $regionType,
                'parent_region' => $regionParent,
            ],
        ];
    }

}
