<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->title(),
            'slug' => Str::slug($this->faker->title()),
            'body' => $this->faker->paragraphs(500, true),
            'published_at' => $this->faker->dateTimeThisDecade(),
        ];
    }
}
