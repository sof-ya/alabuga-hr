<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

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
