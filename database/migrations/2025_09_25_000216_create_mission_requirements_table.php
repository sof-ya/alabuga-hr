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
        Schema::create('mission_requirements', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('mission_id')->comment('Идентификатор миссии');
            $table->foreign('mission_id')->references('id')->on('missions')->index('mission_id')->onDelete('cascade');

            $table->unsignedBigInteger('branch_requirement_id')->nullable()->comment('Выполненная ветка миссий, которая требуется для активации миссии');
            $table->foreign('branch_requirement_id')->references('id')->on('branches')->index('branch_requirement_id')->onDelete('cascade');

            $table->unsignedBigInteger('mission_requirement_id')->nullable()->comment('Выполненная миссия, которая требуется для активации миссии');
            $table->foreign('mission_requirement_id')->references('id')->on('missions')->index('mission_requirement_id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_requirements');
    }
};
