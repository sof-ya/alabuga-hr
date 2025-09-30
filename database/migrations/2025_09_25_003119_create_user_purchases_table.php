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
        Schema::create('user_purchases', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->comment('Идентификатор пользователя, совершившего покупку');
            $table->foreign('user_id')->references('id')->on('users')->index('user_id')->onDelete('cascade');

            $table->unsignedBigInteger('store_item_id')->comment('Идентификатор купленного товара');
            $table->foreign('store_item_id')->references('id')->on('store_items')->index('store_item_id')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_purchases');
    }
};
