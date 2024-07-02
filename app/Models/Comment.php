<?php

namespace App\Models;

use App\Observers\CommentObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'timestamp'];
    protected $with = ['reacted', 'user', 'hide', 'report', 'replies'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function replies(){
        return $this->hasMany(Self::class, 'comment_id', 'id')->where('user_id', request()->user()->id ?? null);
    }

    public function reactions(){
        return $this->morphMany(Reaction::class, 'reactionable');
    }

    public function reacted(){
        return $this->morphOne(Reaction::class, 'reactionable')->where('user_id', request()->user()->id ?? null);
    }

    public function hide(){
        return $this->morphOne(Hide::class, 'hideable')->where('user_id', request()->user()->id ?? null);
    }

    public function report(){
        return $this->morphOne(Report::class, 'reportable')->where('user_id', request()->user()->id ?? null);
    }


}
