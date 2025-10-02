<?php

namespace Database\Factories;

use App\Models\Branch;
use App\Models\Rank;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Branch>
 */
class BranchFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->words(3, true),
            'description' => fake()->text(),
            'priority_rank' => fake()->unique()->randomNumber(Branch::all()->count()+1),
            'requirement_role_id' => Role::where('name', 'Кандидат')->first()->id,
            'requirement_rank_id' => Rank::all()->random()->id,
            'requirement_experience' => fake()->numberBetween(0, 100),
            'is_visible' => true,
            'is_active' => true,
            'reward_experience' => fake()->numberBetween(0, 100),
            'reward_gold' => fake()->numberBetween(0, 100),
        ];
    }
}
