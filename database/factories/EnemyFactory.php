<?php

namespace Database\Factories;

use App\Models\Enemy;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Enemy>
 */
class EnemyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => 'Test Enemy',
            'statblock' => [
                'ac' => 10,
                'hp' => 10,
                'attack_mod' => '+4',
                'damage_dice' => '1d8',
                'damage_mod' => '+2'
            ],
            'challenge_rating' => '1/2'
        ];
    }
}
