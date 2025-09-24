<?php

namespace Database\Seeders;

use App\Models\MissionCategory;
use Illuminate\Database\Seeder;

class MissionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MissionCategory::factory(5)->create();
    }
}
