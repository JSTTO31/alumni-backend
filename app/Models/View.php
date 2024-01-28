<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    use HasFactory;

    protected $guarded = [];

    // public static function booted(){
    //     static::created(function(View $view){
    //         Post::where('id', $view->post_id)->increment('views');
    //     });
    // }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
