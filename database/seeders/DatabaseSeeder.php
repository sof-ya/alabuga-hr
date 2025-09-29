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

        $this->call(MissionCategorySeeder::class);
        $this->call(СompetenceSeeder::class);
        $this->call(MissionSeeder::class);
        $this->call(MissionRewardCompetenceSeeder::class);
        $this->call(StoreItemSeeder::class);
        $this->call(BranchSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'nikname' => 'Test_User',
            'email' => 'test@example.com',
            'role_id' => Role::first()->id,
            'rank_id' => Rank::first()->id,
            'experience' => 0,
            'gold' => 10
        ]);
    }
}
