<?php

namespace Tests\Feature\EnemyController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreEnemyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_enemy_with_all_fields() : void
    {
        $name = 'Store Test';
        $statblock = 'www.dndbeyond.com';
        $challenge_rating = '1';

        $response = $this->json('POST', 'api/enemy', [
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challenge_rating,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('enemies', [
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challenge_rating,
        ]);
    }

    public function test_it_does_not_store_an_enemy_without_a_name() : void
    {
        $statblock = 'www.dndbeyond.com';
        $challenge_rating = '1';

        $response = $this->json('POST', 'api/enemy', [
            'statblock'        => $statblock,
            'challenge_rating' => $challenge_rating,
        ]);

        $response->assertNotFound();
    }

}
