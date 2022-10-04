<?php

namespace Tests\Feature\EncounterController;

use App\Models\Encounter;
use App\Models\Enemy;
use App\Models\Region;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowEncounterControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_encounter_with_multiple_regions_and_enemies() : void
    {
        $regions = Region::factory(2)->create();
        $enemies = Enemy::factory(3)->create();

        $name = 'Show Encounter';
        $description = 'A test encounter';
        $difficulty = 'Trivial';
        $encounter = Encounter::factory()
            ->hasAttached($regions)
            ->hasAttached($enemies)
            ->create([
                'name'        => $name,
                'description' => $description,
                'difficulty'  => $difficulty,
            ]);

        $response = $this->get('api/encounter/' . $encounter->getKey());

        $response->assertJsonFragment([
            'name'        => $name,
            'description' => $description,
            'regions'     => $regions->toArray(),
            'enemies'     => $enemies->toArray(),
            'difficulty'  => $difficulty,
        ]);
    }

    public function test_it_returns_an_encounter_with_one_region_and_one_enemy() : void
    {
        $region = Region::factory()->create();
        $enemy = Enemy::factory()->create();

        $name = 'Show Encounter';
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

        $response = $this->get('api/encounter/' . $encounter->getKey());

        $response->assertJsonFragment([
            'name' => $enemy->name,
        ]);

        $response->assertJsonFragment([
            'id'          => $encounter->getKey(),
            'name'        => $name,
            'description' => $description,
            'difficulty'  => $difficulty,
            'regions'     => [$region],
            'enemies'     => [$enemy],
        ]);
    }

}
