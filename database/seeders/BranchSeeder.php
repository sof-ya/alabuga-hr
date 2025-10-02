<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\Mission;
use App\Models\MissionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 5; $i++) { 
            $branches = Branch::factory(1)->create();
            $missions= Mission::factory(5)->hasAttached($branches)->create();
        }
    }
}
