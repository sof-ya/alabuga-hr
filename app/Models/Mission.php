<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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
