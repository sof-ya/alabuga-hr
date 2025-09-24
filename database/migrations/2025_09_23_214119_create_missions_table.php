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
        Schema::create('missions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название категории');
            $table->text('description')->nullable()->comment('Описание категории');
            $table->text('image_url')->nullable()->comment('Иконка пользователя');
            $table->timestamp('completion_deadline')->nullable();

            $table->unsignedInteger('mission_category_id')->comment('Идентификатор типа миссии');
            $table->foreign('mission_category_id')->references('id')->on('mission_categories')->index('mission_category_id')->onDelete('cascade');

            $table->unsignedInteger('requirement_role_id')->comment('Необходимая роль');
            $table->foreign('requirement_role_id')->references('id')->on('roles')->index('requirement_role_id')->onDelete('cascade');

            $table->unsignedInteger('requirement_rank_id')->comment('Необходимый ранг');
            $table->foreign('requirement_rank_id')->references('id')->on('ranks')->index('requirement_rank_id')->onDelete('cascade');

            $table->integer('requirement_experience')->comment('Необходимое значение опыта');
            $table->boolean('is_visible')->comment('Флаг видимости миссии (серым), если она пока недоступна');
            $table->boolean('is_active')->comment('Флаг активности миссии (вкл/выкл)');
            $table->integer('reward_experience')->comment('Опыт за завершение миссии');
            $table->integer('reward_gold')->comment('Золото за завершение миссии');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('missions');
    }
};
