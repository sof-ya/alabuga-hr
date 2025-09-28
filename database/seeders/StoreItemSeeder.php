<?php

namespace Database\Seeders;

use App\Models\StoreItem;
use Illuminate\Database\Seeder;

class StoreItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StoreItem::factory(10)->create();
    }
}
