<?php

namespace Tests\Feature\EnemyResourceController;

use App\Models\Enemy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowEnemyResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_enemy() : void
    {
        $name = 'Show Enemy';
        $statblock = 'www.dndbeyond.com/show';
        $challengeRating = '1';
        $enemy = Enemy::factory()->create([
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challengeRating,
        ]);

        $response = $this->json('GET', 'api/enemy/' . $enemy->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'             => $name,
                    'statblock'        => $statblock,
                    'challenge_rating' => $challengeRating,
                ],
            ]
        );
    }
}
