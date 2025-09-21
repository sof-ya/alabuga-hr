<?php

namespace Database\Seeders;

use App\Models\Rank;
use App\Models\Role;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'role_id' => Role::first()->id,
            'rank_id' => Rank::first()->id,
            'experience' => 0,
            'mana' => 10
        ]);
    }
}
