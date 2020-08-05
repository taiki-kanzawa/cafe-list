<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $fillable = [
        'user_id', 'cafe_name', 'address', 'wifi', 'electrical_outlet', 'smoking_seat', 'parking', 'meal_menu'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function cafe_images()
    {
        return $this->hasMany(CafeImage::class);
    }
    
    public function first_image()
    {
        return $this->cafe_images()->orderBy('created_at')->first();
    }
}
