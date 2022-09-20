<?php

namespace Tests\Feature\EnemyController;

use App\Models\Enemy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\Routing\Exception\MethodNotAllowedException;
use Tests\TestCase;

class DestroyEnemyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_destroys_an_enemy() : void
    {
        $enemy = Enemy::factory()->create();

        $this->json('DELETE', 'api/enemy/' . $enemy->getKey());

        $this->assertDatabaseMissing('enemies', $enemy->toArray());
    }

    public function test_it_returns_405_without_an_id() : void
    {
        $this->json('DELETE', 'api/enemy/')->assertStatus(405);
    }

}
