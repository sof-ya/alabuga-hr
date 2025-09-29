<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Facades\DB;

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
                return $this->defaultBuilder()
                    ->select([
                        DB::raw("COUNT(*) as total_count"),
                        DB::raw("SUM(CASE WHEN um.status_mission  = 'Завершено' THEN 1 ELSE 0 END) as finished"),
                        DB::raw("CAST(ROUND((SUM(CASE WHEN um.status_mission  = 'Завершено' THEN 1 ELSE 0 END) * 100.0 / COUNT(*)), 0) AS INTEGER) as finished_percent")
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
}
