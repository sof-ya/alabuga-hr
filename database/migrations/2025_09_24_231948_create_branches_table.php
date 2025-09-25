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
        Schema::create('branches', function (Blueprint $table) {
            $table->id();

            $table->string('name')->comment('Название ветки');
            $table->text('description')->nullable()->comment('Подробное описание ветки');
            $table->text('image_url')->nullable()->comment('Ссылка на изображение ветки');
            $table->integer('priority_rank')->comment('Позиция ветки у пользователя в профиле');

            $table->unsignedInteger('requirement_role_id')->comment('Необходимая роль');
            $table->foreign('requirement_role_id')->references('id')->on('roles')->index('requirement_role_id')->onDelete('cascade');

            $table->unsignedInteger('requirement_rank_id')->comment('Необходимый ранг');
            $table->foreign('requirement_rank_id')->references('id')->on('ranks')->index('requirement_rank_id')->onDelete('cascade');;
            
            $table->integer('requirement_experience')->comment('Необходимое значение опыта');
            $table->boolean('is_visible')->comment('Флаг видимости ветки (серым), если она пока недоступна');
            $table->timestamp('completion_deadline')->nullable()->comment('Крайний срок выполнения всей ветки');
            $table->boolean('is_active')->comment('Флаг активности ветки (вкл/выкл)');
            $table->integer('reward_experience')->comment('Опыт за завершение ветки');
            $table->integer('reward_gold')->comment('Золото за завершение ветки');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branches');
    }
};
