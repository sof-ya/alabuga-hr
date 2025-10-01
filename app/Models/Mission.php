<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: "Mission",
    description: "Модель задания/миссии",
    required: ["name", "mission_category_id", "requirement_role_id", "requirement_rank_id", "requirement_experience", "reward_experience", "reward_gold"],
    properties: [
        new OAT\Property(property: "id", type: "integer", format: "int64", description: "ID миссии", example: 1),
        new OAT\Property(property: "name", type: "string", description: "Название миссии", example: "Первое задание"),
        new OAT\Property(property: "description", type: "string", nullable: true, description: "Описание миссии", example: "Выполните первое задание для получения опыта"),
        new OAT\Property(property: "image_url", type: "string", nullable: true, description: "Иконка миссии", example: "missions/first.png"),
        new OAT\Property(property: "completion_deadline", type: "string", format: "date-time", nullable: true, description: "Дедлайн выполнения миссии"),
        new OAT\Property(property: "mission_category_id", type: "integer", format: "int64", description: "ID типа миссии", example: 1),
        new OAT\Property(property: "requirement_role_id", type: "integer", format: "int64", description: "ID необходимой роли", example: 1),
        new OAT\Property(property: "requirement_rank_id", type: "integer", format: "int64", description: "ID необходимого ранга", example: 1),
        new OAT\Property(property: "requirement_experience", type: "integer", description: "Необходимое значение опыта", example: 500),
        new OAT\Property(property: "is_visible", type: "boolean", description: "Флаг видимости миссии", example: true),
        new OAT\Property(property: "is_active", type: "boolean", description: "Флаг активности миссии", example: true),
        new OAT\Property(property: "is_requirement_text", type: "boolean", description: "Обязательность описания результата", example: false),
        new OAT\Property(property: "is_requirement_file", type: "boolean", description: "Обязательность прикрепления файла", example: true),
        new OAT\Property(property: "reward_experience", type: "integer", description: "Опыт за завершение", example: 100),
        new OAT\Property(property: "reward_gold", type: "integer", description: "Золото за завершение", example: 50),
        new OAT\Property(property: "created_at", type: "string", format: "date-time", description: "Дата создания"),
        new OAT\Property(property: "updated_at", type: "string", format: "date-time", description: "Дата обновления"),
    ]
)]
class Mission extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'image_url',
        'completion_deadline',
        'mission_category_id',
        'requirement_role_id',
        'requirement_rank_id',
        'requirement_experience',
        'is_visible',
        'is_active',
        'reward_experience',
        'reward_gold'
    ];

    protected $with = [
        'role'
    ];

    protected $appends = [
        'status',
        'result'
    ];

    public function missionCategory() : BelongsTo {
        return $this->belongsTo(MissionCategory::class);
    }

    public function role() : BelongsTo {
        return $this->belongsTo(Role::class);
    }
    
    public function requirementRank() : BelongsTo {
        return $this->belongsTo(Rank::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_missions')
                    ->withPivot('status_mission', 'result');
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function () {
                $user = $this->users()->where('users.id', auth()->user()->id)->first();
                return $user ? $user->pivot->status_mission : null;
            }
        );
    }

    protected function result(): Attribute
    {
        return Attribute::make(
            get: function () {
                $user = $this->users->first();
                return $user ? $user->pivot->result : null;
            }
        );
    }
}
