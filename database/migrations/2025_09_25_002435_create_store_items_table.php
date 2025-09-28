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
        Schema::create('store_items', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Название категории');
            $table->text('description')->nullable()->comment('Описание категории');
            $table->integer('price')->comment('Опыт за завершение миссии');
            $table->text('image')->nullable()->comment('Иконка пользователя');
            $table->integer('items_count')->comment('Сколько товаров выставлено на продажу');
            $table->boolean('is_available')->comment('Флаг доступности товаров');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('store_items');
    }
};
