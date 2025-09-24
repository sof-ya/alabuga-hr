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

            $table->unsignedInteger('user_id')->comment('Идентификатор пользователя');
            $table->foreign('user_id')->references('id')->on('users')->index('user_id')->onDelete('cascade');

            $table->unsignedInteger('mission_id')->comment('Идентификатор миссии');
            $table->foreign('mission_id')->references('id')->on('missions')->index('mission_id')->onDelete('cascade')->comment('Идентификатор миссии');
            
            $table->string('result')->comment('Статус миссии для пользователя');
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
