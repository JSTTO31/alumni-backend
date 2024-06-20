<?php

namespace App\Traits;

use App\Models\User;
use App\Models\View;

Trait Viewable
{
    public function addView(User $viewer){
        if($this->id == $viewer->id && self::class == 'App\Models\User') return;

        $view = $this->viewers()->updateOrCreate([
            'user_id' => $viewer->id,
        ]);

        if($view->wasRecentlyCreated){
            $this->views_count++;
            $this->save();
        }
    }

    public function views(){
        return $this->hasMany(View::class);
    }

    public function viewers(){
        return $this->morphMany(View::class, 'viewable');
    }

    public function viewersPopular($limit = 5){
        return User::whereHas('views', function($query){
            $query->where('viewable_id', $this->id)->where('viewable_type', self::class)->where('user_id', '<>', $this->id);
        })->limit($limit)->get();
    }
}
