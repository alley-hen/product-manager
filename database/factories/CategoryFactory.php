<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory
 */
class CategoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->word,
            'meta_title' => fake()->word,
            'meta_description' => fake()->word,
            'meta_keywords' => fake()->word,
        ];
    }
}
