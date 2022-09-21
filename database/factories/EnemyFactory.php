<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EnemyFactory extends Factory
{
    public function definition() : array
    {
        return [
            'name'             => 'Skeleton',
            'statblock'        => 'https://www.dndbeyond.com/monsters/17015-skeleton',
            'challenge_rating' => '1/4',
        ];
    }

    public function withUniqueName() : self
    {
        return $this->state(function () {
            return [
                'name' => $this->faker->unique()->name,
            ];
        });
    }
}
