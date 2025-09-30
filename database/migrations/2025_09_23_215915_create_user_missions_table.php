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
        Schema::create('user_missions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('Идентификатор пользователя');
            $table->foreign('user_id')->references('id')->on('users')->index('user_id')->onDelete('cascade');

            $table->unsignedBigInteger('mission_id')->comment('Идентификатор миссии');
            $table->foreign('mission_id')->references('id')->on('missions')->index('mission_id')->onDelete('cascade')->comment('Идентификатор миссии');
            
            $table->string('status_mission')->comment('Статус миссии для пользователя');
            $table->json('result')->comment('Результат выполнение миссии для пользователя');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_missions');
    }
};
