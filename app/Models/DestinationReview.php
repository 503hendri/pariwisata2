<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DestinationReview extends Model
{
    protected $fillable = [
        'destination_id',
        'name',
        'email',
        'phone',
        'rating',
        'comment',
    ];
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
}
