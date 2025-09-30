<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: "Role",
    description: "Модель роли пользователя",
    required: ["name"],
    properties: [
        new OAT\Property(property: "id", type: "integer", format: "int64", description: "ID роли", example: 1),
        new OAT\Property(property: "name", type: "string", description: "Название роли", example: "admin"),
        new OAT\Property(property: "description", type: "string", nullable: true, description: "Описание роли", example: "Администратор системы"),
        new OAT\Property(property: "created_at", type: "string", format: "date-time", description: "Дата создания"),
        new OAT\Property(property: "updated_at", type: "string", format: "date-time", description: "Дата обновления"),
        new OAT\Property(property: "deleted_at", type: "string", format: "date-time", nullable: true, description: "Дата удаления"),
    ]
)]

class Role extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
    
    public function missions() : HasMany {
        return $this->hasMany(Mission::class);
    }
}
