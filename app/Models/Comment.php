<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'timestamp'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Self::class, 'comment_id', 'id')
                ->with(['user', 'reacted', 'reactions'])
                ->withCount(['reactions']);
    }

    public function reactions(){
        return $this->hasMany(Reaction::class, 'mark_id')->where('type', 'comment');
    }

    public function reacted(){
        return $this->hasOne(Reaction::class, 'mark_id')->where('type', 'comment')->where('user_id', request()->user()->id ?? null);
    }


}
