<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    
    public function cafes()
    {
        return $this->hasMany(Cafe::class);
    }
    
    // 多対多の関係
    public function favorites()
    {
        return $this->belongsToMany(Cafe::class, 'favorites', 'user_id', 'cafe_id')->withTimestamps();
    }
    
    // お気に入りに追加
    public function favorite($cafeId)
    {
        $exist = $this->is_favorite($cafeId);
        
        if ($exist == false) {
            $this->favorites()->attach($cafeId);
            return true;
        }
        else {
            return false;
        }
    }
    
    // お気に入りから削除
    public function unfavorite($cafeId)
    {
        $exist = $this->is_favorite($cafeId);
        
        if ($exist == true) {
            $this->favorites()->detach($cafeId);
            return true;
        }
        else {
            return false;
        }
    }
    
    public function is_favorite($cafeId)
    {
        return $this->favorites()->where('cafe_id', $cafeId)->exists();
    }
}
