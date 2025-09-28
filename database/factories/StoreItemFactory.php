<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StoreItem>
 */
class StoreItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->title(),
            'description' => fake()->text(),
            'price' => fake()->numberBetween(0, 100),
            'items_count' => fake()->numberBetween(0, 100),
            'is_available' => true
        ];
    }
}
