<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function counts($user) {
        $count_cafes = $user->cafes()->count();
        $count_favorites = $user->favorites()->count();
        
        return [
            'count_cafes' => $count_cafes,
            'count_favorites' => $count_favorites,
        ];
    }
}
