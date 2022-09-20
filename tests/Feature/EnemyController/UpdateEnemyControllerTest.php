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

    public function test_it_returns_unprocessable_with_duplicate_name() : void
    {
        $name = 'Update Test';
        Enemy::factory()->create([
            'name' => $name,
        ]);
        $enemy = Enemy::factory()->create();

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), ['name' => $name]);

        $response->assertUnprocessable();
        $response->assertSee('The name has already been taken.');
    }

    /**
     * @dataProvider ProvidesValidPayloads
     */
    public function test_it_returns_success_with_valid_payloads($payload) : void
    {
        $enemy = Enemy::factory()->create();

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), $payload);

        $response->assertSuccessful();
    }

    /**
     * @dataProvider ProvidesInvalidPayloads
     */
    public function test_it_returns_unprocessable_with_invalid_payloads($payload, $errors) : void
    {
        $enemy = Enemy::factory()->create();

        $response = $this->json('PUT', 'api/enemy/' . $enemy->getKey(), $payload);

        $response->assertUnprocessable()->assertSee($errors);
    }

    public function ProvidesValidPayloads() : array
    {
        $name = 'Update enemy';
        $statblock = 'www.dndbeyond.com/update';
        $challengeRating = '1';

        return [
            'Name only'                      => [
                'payload' => [
                    'name' => $name,
                ],
            ],
            'Statblock only'                 => [
                'payload' => [
                    'statblock' => $statblock,
                ],
            ],
            'Challenge rating only'          => [
                'payload' => [
                    'challenge_rating' => $challengeRating,
                ],
            ],
            'Name and Statblock'             => [
                'payload' => [
                    'name'      => $name,
                    'statblock' => $statblock,
                ],
            ],
            'Name and Challenge Rating'      => [
                'payload' => [
                    'name'             => $name,
                    'challenge_rating' => $challengeRating,
                ],
            ],
            'Statblock and Challenge Rating' => [
                'payload' => [
                    'name'      => $name,
                    'statblock' => $statblock,
                ],
            ],
            'All fields'                     => [
                'payload' => [
                    'name'             => $name,
                    'statblock'        => $statblock,
                    'challenge_rating' => $challengeRating,
                ],
            ],
        ];
    }

    public function ProvidesInvalidPayloads() : array
    {
        $validName = 'Update Enemy';
        $validStatblock = 'www.dndbeyond.com/update';
        $validChallengeRating = '1';
        return [
            'Name is an integer'             => [
                'payload' => [
                    'name'             => 123,
                    'statblock'        => $validStatblock,
                    'challenge_rating' => $validChallengeRating,
                ],
                'errors'  => [
                    'The name must be a string',
                ],
            ],
            'Statblock is an integer'        => [
                'payload' => [
                    'name'             => $validName,
                    'statblock'        => 123,
                    'challenge_rating' => $validChallengeRating,
                ],
                'errors'  => [
                    'The statblock must be a string',
                ],
            ],
            'Challenge Rating is an integer' => [
                'payload' => [
                    'name'             => $validName,
                    'statblock'        => $validStatblock,
                    'challenge_rating' => 123,
                ],
                'errors'  => [
                    'The challenge rating must be a string',
                ],
            ],
            'All fields are integers'        => [
                'payload' => [
                    'name'             => 123,
                    'statblock'        => 123,
                    'challenge_rating' => 123,
                ],
                'errors'  => [
                    'The name must be a string. (and 2 more errors)',
                ],
            ],
        ];
    }

}
