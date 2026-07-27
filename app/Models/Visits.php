<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visits extends Model
{
    protected $table = 'visits';

    protected $fillable = [
        'id',
        'ip_address',
        'user_agent',
        'referer',
        'path',
        'query',
        'visited_at',
        'created_at',
        'updated_at',
    ];

    protected $dates = ['visited_at'];
}
