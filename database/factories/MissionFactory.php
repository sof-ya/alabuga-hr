<?php

namespace Database\Factories;

use App\Models\MissionCategory;
use App\Models\Rank;
use App\Models\Role;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Mission>
 */
class MissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'description' => fake()->text(),
            'completion_deadline' => fake()->dateTimeBetween('now', '+30 days'),
            'mission_category_id' => MissionCategory::all()->random()->id,
            'requirement_role_id' => Role::all()->random()->id,
            'requirement_rank_id' => Rank::all()->random()->id,
            'requirement_experience' => fake()->numberBetween(0, 100),
            'is_visible' => true,
            'is_active' => true,
            'reward_experience' => fake()->numberBetween(0, 100),
            'reward_gold' => fake()->numberBetween(0, 100),
        ];
    }
}
