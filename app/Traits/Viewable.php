<?php

namespace App\Traits;

use App\Models\User;
use App\Models\View;

Trait Viewable
{
    public function addView(User $viewer){
        return View::updateOrCreate([
            'viewable_id' => $this->id,
            'user_id' => $viewer->id,
            'type' => self::class,
        ], [
            'viewable_id' => $this->id,
            'user_id' => $viewer->id,
            'type' => self::class,
        ]);
    }

    public function viewers(){
        return $this->hasMany(View::class, 'viewable_id')->where('type', self::class);
    }

    public function views(){
        return $this->hasMany(View::class, 'user_id');
    }

    public function viewersPopular($limit = 5){
        return User::whereHas('views', function($query){
            $query->where('viewable_id', $this->id)->where('type', self::class);
        })->limit($limit)->get();
    }
}
