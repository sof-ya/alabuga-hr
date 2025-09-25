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
        Schema::create('branch_missions', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('branch_id')->comment('Идентификатор ветки');
            $table->foreign('branch_id')->references('id')->on('branches')->index('branch_id')->onDelete('cascade');

            $table->unsignedInteger('mission_id')->comment('Идентификатор миссии');
            $table->foreign('mission_id')->references('id')->on('missions')->index('mission_id')->onDelete('cascade');

            $table->integer('mission_order')->comment('Порядковый номер миссии');
            $table->boolean('is_active')->comment('Активна или выключена миссия в ветке');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branch_missions');
    }
};
