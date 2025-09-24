<?php

namespace Database\Seeders;

use App\Models\Сompetence;
use Illuminate\Database\Seeder;

class СompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Сompetence::factory(5)->create();
    }
}
