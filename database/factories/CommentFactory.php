<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */


    public function definition()
    {
        return [
            'comment' => $this->faker->sentences(rand(1, 6), true),
            'created_at' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'updated_at' => $this->faker->dateTimeBetween('-10 years', 'now'),
        ];
    }
}
