<?php

namespace App\Models;

use App\Enums\UserMissionsStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserMission extends Model
{
    protected $table = 'user_missions';

    protected $fillable = [
        'user_id',
        'mission_id',
        'status_mission'
    ];

    protected function casts(): array
    {
        return [
            // "result" => UserMissionsStatusEnum::class,
        ];
    }

    public function mission() : BelongsTo {
        return $this->belongsTo(Mission::class);
    }

    public function user() : BelongsTo {
        return $this->belongsTo(User::class);
    }
}
