<?php

namespace Tests\Feature\EnemyResourceController;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StoreEnemyResourceControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_stores_an_enemy_with_all_fields() : void
    {
        $name = 'Store Test';
        $statblock = 'www.dndbeyond.com';
        $challengeRating = '1';

        $response = $this->json('POST', 'api/enemy', [
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challengeRating,
        ]);

        $response->assertSuccessful();
        $this->assertDatabaseHas('enemies', [
            'name'             => $name,
            'statblock'        => $statblock,
            'challenge_rating' => $challengeRating,
        ]);
    }

    /**
     * @dataProvider ProvidesInvalidPayloads
     */
    public function test_it_does_not_store_an_enemy_with_an_invalid_payload($payload, $errors) : void
    {
        $response = $this->json('POST', 'api/enemy', $payload);

        $response->assertUnprocessable()->assertSee($errors);
    }

    public function ProvidesInvalidPayloads() : array
    {
        $validName = 'Store Enemy';
        $validStatblock = 'www.dndbeyond.com/store';
        $validChallengeRating = '1';
        return [
            'Without a Name'                 => [
                'payload' => [
                    'statblock'        => $validStatblock,
                    'challenge_rating' => $validChallengeRating,
                ],
                'errors'  => [
                    'The name field is required.',
                ],
            ],
            'Without a Statblock'            => [
                'payload' => [
                    'name'             => $validName,
                    'challenge_rating' => $validChallengeRating,
                ],
                'errors'  => [
                    'The statblock field is required.',
                ],
            ],
            'Without a Challenge Rating'     => [
                'payload' => [
                    'name'      => $validName,
                    'statblock' => $validStatblock,
                ],
                'errors'  => [
                    'The challenge rating field is required.',
                ],
            ],
            'Without any fields'     => [
                'payload' => [],
                'errors'  => [
                    'The name field is required.',
                    'The statblock field is required.',
                    'The challenge rating field is required.',
                ],
            ],
            'Name is an integer'             => [
                'payload' => [
                    'name'             => 123,
                    'statblock'        => $validStatblock,
                    'challenge_rating' => $validChallengeRating,
                ],
                'errors'  => [
                    'The name must be a string.',
                ],
            ],
            'Statblock is an integer'        => [
                'payload' => [
                    'name'             => $validName,
                    'statblock'        => 123,
                    'challenge_rating' => $validChallengeRating,
                ],
                'errors'  => [
                    'The statblock must be a string.',
                ],
            ],
            'Challenge Rating is an integer' => [
                'payload' => [
                    'name'             => $validName,
                    'statblock'        => $validStatblock,
                    'challenge_rating' => 123,
                ],
                'errors'  => [
                    'The challenge rating must be a string.',
                ],
            ],
        ];
    }

}
