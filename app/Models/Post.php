<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'timestamp'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function comment(){
        return $this->hasOne(Comment::class);
    }

    public function reactions(){
        return $this->hasMany(Reaction::class, 'mark_id')->where('type', 'post');
    }

    public function reacted(){
        return $this->hasOne(Reaction::class, 'mark_id')->where('type', 'post')->where('user_id', request()->user()->id ?? null);
    }

    public function views(){
        return $this->hasMany(View::class, 'viewable_id')->where('type', self::class);
    }

}

