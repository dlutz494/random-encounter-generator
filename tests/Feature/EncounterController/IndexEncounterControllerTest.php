<?php

namespace Tests\Feature\EncounterController;

use App\Models\Encounter;
use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\TestResponse;
use Tests\TestCase;

class IndexEncounterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_encounter() : void
    {
        $region = Region::factory()->create();
        $enemy = Enemy::factory()->create();
        $name = 'Index Encounter';
        $description = 'A test encounter';
        $difficulty = 'Trivial';
        $encounter = Encounter::factory()
            ->hasAttached($region)
            ->hasAttached($enemy)
            ->create([
                'name'        => $name,
                'description' => $description,
                'difficulty'  => $difficulty,
            ]);

        $response = $this->getResponse();

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                [
                    'id'          => $encounter->getKey(),
                    'name'        => $name,
                    'description' => $description,
                    'difficulty'  => $difficulty,
                    'regions'     => [$region->toArray()],
                    'enemies'     => [$enemy->toArray()],
                ],
            ],
        ]);
    }

    public function getResponse() : TestResponse
    {
        return $this->json('GET', 'api/encounter');
    }

    public function test_it_returns_multiple_encounters() : void
    {
        /** @var Encounter $encounter */
        $region = Region::factory()->create();
        $enemy = Enemy::factory()->create();
        $encounter = Encounter::factory(3)
            ->hasAttached($region)
            ->hasAttached($enemy)
            ->create();
        $response = $this->getResponse();

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                [
                    'id'          => $encounter[0]->getKey(),
                    'name'        => $encounter[0]->name,
                    'description' => $encounter[0]->description,
                    'difficulty'  => $encounter[0]->difficulty,
                    'regions'     => [$region->toArray()],
                    'enemies'     => [$enemy->toArray()],
                ],
                [
                    'id'          => $encounter[1]->getKey(),
                    'name'        => $encounter[1]->name,
                    'description' => $encounter[1]->description,
                    'difficulty'  => $encounter[1]->difficulty,
                    'regions'     => [$region->toArray()],
                    'enemies'     => [$enemy->toArray()],
                ],
                [
                    'id'          => $encounter[2]->getKey(),
                    'name'        => $encounter[2]->name,
                    'description' => $encounter[2]->description,
                    'difficulty'  => $encounter[2]->difficulty,
                    'regions'     => [$region->toArray()],
                    'enemies'     => [$enemy->toArray()],
                ],
            ],
        ]);
    }

    public function test_it_returns_no_encounters() : void
    {
        $response = $this->getResponse();

        $response->assertSuccessful();
        $response->assertJson([]);
    }
}
