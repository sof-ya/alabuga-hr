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
        Schema::create('user_competencies', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id')->comment('Идентификатор пользователя');
            $table->foreign('user_id')->references('id')->on('users')->index('user_id')->onDelete('cascade');

            $table->unsignedInteger('competency_id')->comment('Идентификатор компетенции');
            $table->foreign('competency_id')->references('id')->on('сompetencies')->index('competency_id')->onDelete('cascade');

            $table->integer('level')->comment('Уровень владения компетенцией');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_competencies');
    }
};
