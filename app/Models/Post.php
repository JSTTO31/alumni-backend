<?php

namespace App\Models;

use App\Observers\PostObserver;
use App\Traits\Viewable;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, Viewable, HasUuids;

    protected $guarded = ['id', 'timestamp'];
    protected $with = ['user', 'reacted', 'post_saved', 'hide', 'report', 'data', 'comments'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class)->where('user_id', 1);
    }

    public function comment(){
        return $this->hasOne(Comment::class);
    }

    public function reactions(){
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    public function reacted(){
        return $this->morphOne(Reaction::class, 'reactionable')->where('user_id', request()->user()->id ?? null);
    }

    public function data(){
        return $this->morphTo(__FUNCTION__, 'postable_type', 'postable_id');
    }

    public function post_saved(){
        return $this->morphOne(Save::class, 'saveable')->where('user_id', request()->user()->id ?? null);
    }

    public function hide(){
        return $this->morphOne(Hide::class, 'hideable')->where('user_id', request()->user()->id ?? null);
    }

    public function report(){
        return $this->morphOne(Report::class, 'reportable')->where('user_id', request()->user()->id ?? null);
    }

    public function post(){
        return $this->morphOne(Post::class, 'postable');
    }

    public function posts(){
        return $this->hasMany(self::class, 'postable_id')->where('postable_type', self::class);
    }
}

