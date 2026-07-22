<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Culinary extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'category',
        'price',
        'rating',
        'description',
        'image',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'rating' => 'decimal:1',
    ];
}
