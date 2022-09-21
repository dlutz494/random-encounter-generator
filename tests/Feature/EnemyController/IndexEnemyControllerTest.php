<?php

namespace Tests\Feature\EnemyController;

use App\Models\Enemy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexEnemyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_enemy() : void
    {
        $enemy = Enemy::factory()->create();

        $response = $this->json('GET', 'api/enemy');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => $enemy->name,
                'statblock'        => $enemy->statblock,
                'challenge_rating' => $enemy->challenge_rating,
            ],
        ]);
    }

    public function test_it_returns_multiple_enemies() : void
    {
        $enemy = Enemy::factory(3)->withUniqueName()->create();

        $response = $this->json('GET', 'api/enemy');

        $response->assertSuccessful();
        $response->assertJson([
            [
                'name'             => $enemy[0]->name,
                'statblock'        => $enemy[0]->statblock,
                'challenge_rating' => $enemy[0]->challenge_rating,
            ],
            [
                'name'             => $enemy[1]->name,
                'statblock'        => $enemy[1]->statblock,
                'challenge_rating' => $enemy[1]->challenge_rating,
            ],
            [
                'name'             => $enemy[2]->name,
                'statblock'        => $enemy[2]->statblock,
                'challenge_rating' => $enemy[2]->challenge_rating,
            ],
        ]);
    }

    public function test_it_returns_no_enemies() : void
    {
        $response = $this->json('GET', 'api/enemy');

        $response->assertSuccessful();
        $response->assertJson([]);
    }
}
