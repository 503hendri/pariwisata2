<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteProfile extends Model
{
    protected $fillable = [
        'name',
        'tagline',
        'description',
        'logo',
        'favicon',
        'cover',
        'phone',
        'email',
        'address',
        'instagram',
        'youtube',
        'facebook',
        'tiktok',
    ];
}
