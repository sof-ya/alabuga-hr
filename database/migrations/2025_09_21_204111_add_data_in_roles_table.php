<?php

use App\Models\Role;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $roles = [
            [
                'name' => 'Кандидат'
            ],
            [
                'name' => 'Сотрудник'
            ],
            [
                'name' => 'HR'
            ],
            [
                'name' => 'Организатор'
            ],
            [
                'name' => 'Администратор'
            ]
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::table('roles')->whereIn('name', ['Кандидат', 'Сотрудник', 'HR', 'Организатор', 'Администратор'])->delete();
    }
};
