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
        Schema::create('mission_reward_competences', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('mission_id')->comment('Идентификатор миссии');
            $table->foreign('mission_id')->references('id')->on('missions')->onDelete('cascade')->comment('Идентификатор миссии');

            $table->unsignedBigInteger('competence_id')->comment('Идентификатор компетенции');
            $table->foreign('competence_id')->references('id')->on('competencies')->onDelete('cascade')->comment('Идентификатор компетенции');

            $table->integer('level_increase')->comment('Увеличение уровня компетенции за выполнение миссии');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_reward_competences');
    }
};
