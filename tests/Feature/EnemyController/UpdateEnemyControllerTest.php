<?php

namespace Tests\Feature\EnemyController;

use App\Models\enemy;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UpdateEnemyControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_updates_a_enemy() : void
    {
        $enemy = Enemy::factory()->create();
        $payload = [
            'name'             => 'Update Test',
            'statblock'        => 'www.dndbeyond.com',
            'challenge_rating' => '1',
        ];

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), $payload);

        $response->assertSuccessful();
        $this->assertDatabaseHas('enemies', $payload);
    }

    public function test_it_returns_404_with_duplicate_name() : void
    {
        $name = 'Update Test';
        Enemy::factory()->create([
            'name' => $name,
        ]);
        $enemy = Enemy::factory()->create();

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), ['name' => $name]);

        $response->assertNotFound();
    }

    /**
     * @dataProvider ProvidesValidPayload
     */
    public function test_it_returns_success_with_valid_payloads($payload) : void
    {
        $enemy = Enemy::factory()->create();

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), [$payload]);

        $response->assertSuccessful();
    }

    public function test_it_returns_404_with_invalid_fields() : void
    {
        $enemy = Enemy::factory()->create();
        $payload = [
            'name'             => 123,
            'statblock'        => 123,
            'challenge_rating' => 123,
        ];

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), $payload);

        $response->assertNotFound();
    }

    public function ProvidesValidPayload() : array
    {
        $name = 'Update enemy';
        $statblock = 'www.dndbeyond.com/update';
        $challenge_rating = '1';

        return [
            'Name only'                      => [
                'name' => $name,
            ],
            'Statblock only'                 => [
                'statblock' => $statblock,
            ],
            'Challenge Rating only'          => [
                'challenge_rating' => $challenge_rating,
            ],
            'Name and Statblock'             => [
                'name'      => $name,
                'statblock' => $statblock,
            ],
            'Name and Challenge Rating'      => [
                'name'             => $name,
                'challenge_rating' => $challenge_rating,
            ],
            'Statblock and Challenge Rating' => [
                'name'      => $name,
                'statblock' => $statblock,
            ],
            'All fields'                     => [
                'name'             => $name,
                'statblock'        => $statblock,
                'challenge_rating' => $challenge_rating,
            ],
        ];
    }

}
