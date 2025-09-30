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
        Schema::create('artefacts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('rarity_id')->comment('Редкость артефакта');
            $table->foreign('rarity_id')->references('id')->on('rarities')->onDelete('cascade');

            $table->string('name')->comment('Название артефакта');
            $table->text('description')->nullable()->comment('Описание артефакта');
            $table->text('image_url')->nullable()->comment('Путь к изображению артефакта');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('artefacts');
    }
};
