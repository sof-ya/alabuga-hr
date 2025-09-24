<?php

namespace Database\Seeders;

use App\Models\MissionRewardCompetence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MissionRewardCompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MissionRewardCompetence::factory(5)->create();
    }
}
