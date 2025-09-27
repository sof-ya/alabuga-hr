<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\SoftDeletes;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    properties: [
        new OAT\Property(property: 'id', type: 'integer', format: 'int64', minimum: 1),
        new OAT\Property(property: 'name', type: 'string', maxLength: 255, example: 'Футболка'),
        new OAT\Property(property: 'descrirpion', type: 'string', nullable: true, example: 'Классная футболка'),
        new OAT\Property(property: 'price', type: 'integer', format: 'int4', minimum: 1),
        new OAT\Property(property: 'image', type: 'string', nullable: true, example: 'images/1.jpg'),
        new OAT\Property(property: 'items_count', type: 'integer', format: 'int4', minimum: 1),
        new OAT\Property(property: 'is_available', type: 'boolean'),
        new OAT\Property(property: 'in_purchases', type: 'boolean'),
        new OAT\Property(property: 'is_active', type: 'boolean'),

        new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
        new OAT\Property(property: 'deleted_at', type: 'string', format: 'date-time', nullable: true)
    ],
)]


class StoreItem extends Model
{
    /** @use HasFactory<\Database\Factories\StoreItemFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'image',
        'items_count',
        'is_available'
    ];

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
