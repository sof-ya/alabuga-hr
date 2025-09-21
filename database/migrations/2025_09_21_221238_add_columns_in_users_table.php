<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->comment('Идентификатор роли');
            $table->unsignedInteger('rank_id')->nullable()->comment('Идентификатор ранга');

            $table->foreign('role_id')->references('id')
                  ->on('roles')->index('role_id')->onDelete('cascade');
            $table->foreign('rank_id')->references('id')
                  ->on('ranks')->index('rank_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropSoftDeletes();
        });
    }
};
