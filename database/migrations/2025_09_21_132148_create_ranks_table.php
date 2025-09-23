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
        Schema::create('ranks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название ранга');
            $table->text('description')->nullable()->comment('Описание ранга');
            $table->text('image_url')->nullable()->comment('Изображение ранга');
            $table->integer('required_experience')->comment('Требуемый опыт для получения ранга');
            $table->foreignId('required_role_id')->index()->comment('Требуемая роль для получения ранга');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranks');
    }
};
