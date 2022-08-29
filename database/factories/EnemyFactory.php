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
            'name' => 'Skeleton',
            'statblock' => 'https://www.dndbeyond.com/monsters/17015-skeleton',
            'challenge_rating' => '1/4'
        ];
    }
}
