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

            $table->unsignedBigInteger('user_id')->comment('Идентификатор пользователя');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->unsignedBigInteger('competency_id')->comment('Идентификатор компетенции');
            $table->foreign('competency_id')->references('id')->on('competencies')->onDelete('cascade');

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
