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
        Schema::create('rarities', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Название редкости');
            $table->text('description')->nullable()->comment('Описание редкости');
            $table->text('image')->nullable()->comment('Путь к изображению, обозначающему редкость');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rarities');
    }
};
