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
        Schema::create('user_artefacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('user_id')->comment('Идентификатор пользователя');
            $table->foreign('user_id')->references('id')->on('users')->index('user_id')->onDelete('cascade');

            $table->unsignedInteger('artefact_id')->comment('Идентификатор артефакта');
            $table->foreign('artefact_id')->references('id')->on('artefacts')->index('artefact_id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_artefacts');
    }
};
