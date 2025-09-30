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
        Schema::create('mission_reward_artefacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('mission_id')->comment('Идентификатор миссии');
            $table->foreign('mission_id')->references('id')->on('missions')->index('mission_id')->onDelete('cascade');

            $table->unsignedBigInteger('artefact_id')->comment('Идентификатор артефакта');
            $table->foreign('artefact_id')->references('id')->on('artefacts')->index('artefact_id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mission_reward_artefacts');
    }
};
