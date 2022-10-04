<?php

namespace Tests\Unit\EnemyFactory;

use App\Models\Enemy;
use Tests\TestCase;

class EnemyFactoryTest extends TestCase
{
    public function test_the_factory_creates_an_enemy() : void
    {
        $enemy = Enemy::factory()->create();

        $this->assertNotEmpty($enemy);
        $this->assertNotEmpty($enemy->name);
        $this->assertNotEmpty($enemy->statblock);
        $this->assertNotEmpty($enemy->challenge_rating);
    }

    public function test_the_factory_creates_an_enemy_with_values() : void
    {
        $name = 'Enemy-' . uniqid();
        $statblock = 'https://www.dndbeyond.com/monsters/17077-zombie';
        $challengeRating = '1/4';

        $enemy = Enemy::factory()->create([
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challengeRating,
        ]);

        $this->assertEquals(
            [
                $name,
                $statblock,
                $challengeRating,
            ],
            [
                $enemy->name,
                $enemy->statblock,
                $enemy->challenge_rating,
            ]
        );
    }
}
