<?php

namespace Tests\Feature\EnemyResourceController;

use App\Models\Enemy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyEnemyResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_an_enemy() : void
    {
        $enemy = Enemy::factory()->create();

        $this->assertDatabaseHas('enemies', $enemy->toArray());

        $this->json('DELETE', 'api/enemy/' . $enemy->getKey());

        $this->assertDatabaseMissing('enemies', $enemy->toArray());
    }

    public function test_it_returns_405_without_an_id() : void
    {
        $this->json('DELETE', 'api/enemy/')->assertStatus(405);
    }

}
