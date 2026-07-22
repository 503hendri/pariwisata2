<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Destination extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'thumbnail',
        'cover',
        'address',
        'latitude',
        'longitude',
        'rating',
        'review_count',
        'view_count',
        'entry_fee',
        'price_range_min',
        'price_range_max',
        'operating_hours',
        'phone',
        'website',
        'whatsapp',
        'instagram',
        'facebook',
        'tiktok',
        'is_popular',
        'is_published',
        'meta_title',
        'meta_description',
        'meta_tags',
    ];

    public function images()
    {
        return $this->hasMany(DestinationImage::class);
    }
    
    public function reviews()
    {
        return $this->hasMany(DestinationReview::class);
    }
}
