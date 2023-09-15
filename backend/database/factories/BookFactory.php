<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->numberBetween(1, 10),
            'title' => Str::random(40),
            'author' => $this->faker->name(),
            'page_numbers' => $this->faker->unique()->numberBetween(1, 1000),
            'created_at' => $this->faker->time
        ];
    }
}
