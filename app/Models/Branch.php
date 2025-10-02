<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;

use OpenApi\Attributes as OAT;

#[OAT\Schema(
    schema: "Branch",
    description: "Модель ветки заданий",
    required: ["name", "priority_rank", "requirement_role_id", "requirement_rank_id", "requirement_experience", "is_visible", "is_active", "reward_experience", "reward_gold"],
    properties: [
        new OAT\Property(property: "id", type: "integer", format: "int64", description: "ID ветки", example: 1),
        new OAT\Property(property: "name", type: "string", description: "Название ветки", example: "Основная ветка"),
        new OAT\Property(property: "description", type: "string", nullable: true, description: "Подробное описание ветки", example: "Основная сюжетная ветка заданий"),
        new OAT\Property(property: "image_url", type: "string", nullable: true, description: "Ссылка на изображение ветки", example: "https://example.com/branches/main.png"),
        new OAT\Property(property: "priority_rank", type: "integer", description: "Позиция ветки у пользователя в профиле", example: 1),
        new OAT\Property(property: "requirement_role_id", type: "integer", format: "int64", description: "ID необходимой роли", example: 1),
        new OAT\Property(property: "requirement_rank_id", type: "integer", format: "int64", description: "ID необходимого ранга", example: 1),
        new OAT\Property(property: "requirement_experience", type: "integer", description: "Необходимое значение опыта", example: 1000),
        new OAT\Property(property: "is_visible", type: "boolean", description: "Флаг видимости ветки", example: true),
        new OAT\Property(property: "completion_deadline", type: "string", format: "date-time", nullable: true, description: "Крайний срок выполнения всей ветки"),
        new OAT\Property(property: "is_active", type: "boolean", description: "Флаг активности ветки", example: true),
        new OAT\Property(property: "reward_experience", type: "integer", description: "Опыт за завершение ветки", example: 500),
        new OAT\Property(property: "reward_gold", type: "integer", description: "Золото за завершение ветки", example: 200),
        new OAT\Property(property: "created_at", type: "string", format: "date-time", description: "Дата создания"),
        new OAT\Property(property: "updated_at", type: "string", format: "date-time", description: "Дата обновления"),
    ]
)]
class Branch extends Model
{
    /** @use HasFactory<\Database\Factories\BranchFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image_url',
        'priority_rank',
        'requirement_role_id',
        'requirement_rank_id',
        'requirement_experience',
        'is_visible',
        'is_active',
        'reward_experience',
        'reward_gold'
    ];

    protected $appends = [
        'progress'
    ];

    public function missions() : BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'branch_missions');
    }

    public function progress() : Attribute {
        return Attribute::make(
            get: function () {
                $connectionType = config('database.default');
                $driver = config("database.connections.{$connectionType}.driver");

                if ($driver === 'pgsql') {
                    $castExpression = "CAST(ROUND((SUM(CASE WHEN um.status_mission = 'Завершено' THEN 1 ELSE 0 END) * 100.0 / COUNT(*)), 0) AS INTEGER)";
                } else {
                    $castExpression = "CAST(ROUND((SUM(CASE WHEN um.status_mission = 'Завершено' THEN 1 ELSE 0 END) * 100.0 / COUNT(*)), 0) AS UNSIGNED)";
                }

                return $this->defaultBuilder()
                    ->select([
                        DB::raw("COUNT(*) as total_count"),
                        DB::raw("SUM(CASE WHEN um.status_mission = 'Завершено' THEN 1 ELSE 0 END) as finished"),
                        DB::raw("{$castExpression} as finished_percent")
                    ])
                    ->groupBy('b.id', 'b.name')->where('b.id', $this->id)->first();
            }
        );
    }

    public function defaultBuilder() : Builder {
        return auth()->user()
            ->join('user_branches as ub', 'users.id', '=', 'ub.user_id')
            ->join('branch_requirements as br', 'ub.branch_id', '=', 'br.branch_id')
            ->join('branches as b', 'br.branch_id', '=', 'b.id')
            ->join('branch_missions as bm', 'b.id', '=', 'bm.branch_id')
            ->join('missions as m', 'bm.mission_id', '=', 'm.id')
            ->join('user_missions as um', 'm.id', '=', 'um.mission_id');
    }

    public function reqRole() : HasOne {
        return $this->hasOne(Role::class, 'id', 'requirement_role_id');
    }

    public function reqRank() : HasOne {
        return $this->hasOne(Rank::class, 'id', 'requirement_rank_id');
    }
}
