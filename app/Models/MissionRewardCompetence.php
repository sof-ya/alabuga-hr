<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MissionRewardCompetence extends Model
{
    use HasFactory;

    protected $fillable = [
        'mission_id',
        'competence_id',
        'level_increase'
    ];
}
