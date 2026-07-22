<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AccomodationImage extends Model
{
    protected $fillable = [
        'accomodation_id',
        'image',
    ];
    
    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }
}
