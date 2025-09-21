<?php

use App\Models\Rank;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $ranks = [
            [
                'name' => 'Искатель',
                'required_experience' => 0,
                'required_role_id' => DB::table('roles')->where('name', 'Кандидат')->first()->id
            ],
            [
                'name' => 'Разведчик',
                'required_experience' => 500,
                'required_role_id' => DB::table('roles')->where('name', 'Кандидат')->first()->id
            ],
            [
                'name' => 'Пилот-кандидат',
                'required_experience' => 1000,
                'required_role_id' => DB::table('roles')->where('name', 'Кандидат')->first()->id
            ],
        ];


        foreach ($ranks as $role) {
            Rank::create($role);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('ranks')->whereIn('name', ['Искатель', 'Разведчик', 'Пилот-кандидат'])->delete();
    }
};
