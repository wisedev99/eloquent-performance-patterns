<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LoginFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ip_address' => $this->faker->ipv4(),
            'created_at' => $this->faker->dateTimeThisDecade('now'),
        ];
    }
}
