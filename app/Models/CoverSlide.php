<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CoverSlide extends Model
{
    protected $fillable = [
        'image_path',
        'caption',
        'order',
        'is_active',
    ];
}
