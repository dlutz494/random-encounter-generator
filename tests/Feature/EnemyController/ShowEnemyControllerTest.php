<?php

namespace Tests\Feature\EnemyController;

use App\Models\Enemy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowEnemyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_returns_an_enemy() : void
    {
        $name = 'Show Enemy';
        $statblock = 'www.dndbeyond.com';
        $challenge_rating = '2';
        $enemy = Enemy::factory()->create([
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challenge_rating,
        ]);

        $response = $this->json('GET', 'api/enemy/' . $enemy->getKey());

        $response->assertSuccessful();
        $response->assertJson(
            [
                'data' => [
                    'name'             => $name,
                    'statblock'        => $statblock,
                    'challenge_rating' => $challenge_rating,
                ],
            ]
        );
    }
}
