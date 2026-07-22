<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'type',
        'address',
        'latitude',
        'longitude',
        'price_range',
        'phone',
        'whatsapp',
        'website',
        'thumbnail',
        'cover',
        'rating',
        'is_featured',
        'is_active',
    ];
    
    public function images()
    {
        return $this->hasMany(AccomodationImage::class);
    }
}
