<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Сompetence extends Model
{
    use HasFactory;
    
    protected $table = 'сompetencies';

    protected $fillable = [
        'name',
        'description'
    ];
}
