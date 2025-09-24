<?php

namespace Database\Factories;

use App\Models\Mission;
use App\Models\Сompetence;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MissionRewardCompetence>
 */
class MissionRewardCompetenceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'mission_id' => Mission::all()->random()->id,
            'competence_id' => Сompetence::all()->random()->id,
            'level_increase' => fake()->numberBetween(0, 100),
        ];
    }
}
