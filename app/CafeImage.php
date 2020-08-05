<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CafeImage extends Model
{
    protected $fillable = [
        'cafe_id', 'image'    
    ];
    
    public function cafe()
    {
        return $this->belongsTo(Cafe::class);
    }
}
