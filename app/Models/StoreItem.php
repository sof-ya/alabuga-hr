<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class StoreItem extends Model
{
    /** @use HasFactory<\Database\Factories\StoreItemFactory> */
    use HasFactory;

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_purchases');
    }
}
