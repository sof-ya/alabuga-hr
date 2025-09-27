<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;


class StoreItem extends Model
{
    /** @use HasFactory<\Database\Factories\StoreItemFactory> */
    use HasFactory;

    protected $appends = [
        'in_purchases',
        'is_active'
    ];

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_purchases');
    }

    public function inPurchases() : Attribute {
        return Attribute::get(fn (): bool => 
            $this->users()->where('user_id', auth()->user()->id)->exists()
        );
    }
    
    public function isActive() : Attribute {
        return Attribute::get(fn (): bool => 
            ($this->items_count>0) && ($this->is_available)
        );
    }
}
