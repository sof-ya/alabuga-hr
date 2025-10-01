<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: "Competence",
    description: "Модель компетенций",
    required: ["name"],
    properties: [
        new OAT\Property(property: "id", type: "integer", format: "int64", description: "ID компетенции", example: 1),
        new OAT\Property(property: "name", type: "string", description: "Название компетенции", example: "Название"),
        new OAT\Property(property: "description", type: "string", nullable: true, description: "Описание компетенции", example: "Очень полезная компетенция"),
        new OAT\Property(property: "created_at", type: "string", format: "date-time", description: "Дата создания"),
        new OAT\Property(property: "updated_at", type: "string", format: "date-time", description: "Дата обновления"),
    ]
)]
class Competence extends Model
{
    use HasFactory;
    
    protected $table = 'competencies';

    protected $fillable = [
        'name',
        'description'
    ];
}
