<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: "Rank",
    description: "Модель ранга пользователя",
    required: ["name", "required_experience", "required_role_id"],
    properties: [
        new OAT\Property(property: "id", type: "integer", format: "int64", description: "ID ранга", example: 1),
        new OAT\Property(property: "name", type: "string", description: "Название ранга", example: "beginner"),
        new OAT\Property(property: "description", type: "string", nullable: true, description: "Описание ранга", example: "Начинающий игрок"),
        new OAT\Property(property: "image_url", type: "string", nullable: true, description: "Изображение ранга", example: "https://example.com/ranks/beginner.png"),
        new OAT\Property(property: "required_experience", type: "integer", description: "Требуемый опыт для получения ранга", example: 1000),
        new OAT\Property(property: "required_role_id", type: "integer", format: "int64", description: "ID требуемой роли", example: 1),
        new OAT\Property(property: "created_at", type: "string", format: "date-time", description: "Дата создания"),
        new OAT\Property(property: "updated_at", type: "string", format: "date-time", description: "Дата обновления"),
        new OAT\Property(property: "deleted_at", type: "string", format: "date-time", nullable: true, description: "Дата удаления"),
    ]
)]
class Rank extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'required_experience',
        'required_role_id'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function missions() : HasMany {
        return $this->hasMany(Mission::class);
    }
}
