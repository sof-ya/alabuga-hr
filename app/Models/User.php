<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Tymon\JWTAuth\Contracts\JWTSubject;
use OpenApi\Attributes as OAT;

#[OAT\Schema(
    properties: [
        new OAT\Property(property: 'id', type: 'integer', format: 'int64', minimum: 1),
        new OAT\Property(property: 'name', type: 'string', format: 'email'),
        new OAT\Property(property: 'nikname', type: 'string', format: 'email'),
        new OAT\Property(property: 'image_url', type: 'string'),
        new OAT\Property(property: 'email', type: 'string', maxLength: 255),
        new OAT\Property(property: 'experience', type: 'integer'),
        new OAT\Property(property: 'gold', type: 'integer'),
        new OAT\Property(property: 'role_id', type: 'integer', format: 'int64', minimum: 1),
        new OAT\Property(property: 'rank_id', type: 'integer', format: 'int64', minimum: 1),
        
        new OAT\Property(property: 'created_at', type: 'string', format: 'date-time', nullable: true),
        new OAT\Property(property: 'updated_at', type: 'string', format: 'date-time', nullable: true),
        new OAT\Property(property: 'deleted_at', type: 'string', format: 'date-time', nullable: true),
    ],
)]

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'experience',
        'gold'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    protected $with = [
        'role',
        'rank'
    ];


    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function rank(): BelongsTo
    {
        return $this->belongsTo(Rank::class);
    }

    public function missions() : BelongsToMany
    {
        return $this->belongsToMany(Mission::class, 'user_missions');
    }

    public function storeItems() : BelongsToMany
    {
        return $this->belongsToMany(StoreItem::class, 'user_purchases');
    }

    public function branches() : BelongsToMany
    {
        return $this->belongsToMany(Branch::class, 'user_branches');
    }
}
