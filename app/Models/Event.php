<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'date_start',
        'date_end',
        'time_start',
        'time_end',
        'location',
        'latitude',
        'longitude',
        'ticket_price',
        'is_free',
        'cover',
        'organizer',
        'contact_phone',
        'website',
        'is_published',
    ];

    protected $casts = [
        // 'date_start' => 'date',
        // 'date_end' => 'date',
        // 'time_start' => 'time',
        // 'time_end' => 'time',
        'is_free' => 'boolean',
        'is_published' => 'boolean',
    ];
}
