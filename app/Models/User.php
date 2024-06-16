<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Connection;
use App\Traits\Profile;
use App\Traits\Viewable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelFollow\Traits\Follower;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Follower, Followable, Connection, Viewable, Profile;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'profile_picture_relationship',
        'profile_cover_relationship'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    protected $appends = [
        'picture',
        'profile_picture',
        'profile_cover',
        'cover'
    ];

    protected $with = [
        'general_information',
    ];

    public function profile_picture_relationship() : MorphOne{
        return $this->morphOne(Image::class, 'imageable')->where('type', 'profile');
    }

    public function profile_cover_relationship() : MorphOne{
        return $this->morphOne(Image::class, 'imageable')->where('type', 'cover');
    }

    public function getPictureAttribute(){
        $picture = $this->profile_picture_relationship->location ?? '/profiles/dummy-profile.png';
        return request()->getSchemeAndHttpHost() . "/storage/" . $picture;
    }

    public function getProfilePictureAttribute() {
        if(!$this->profile_picture_relationship){
            return null;
        }
        if(is_string($this->profile_picture_relationship->data)){
            $this->profile_picture_relationship->data = json_decode($this->profile_picture_relationship->data);
        }
        return $this->profile_picture_relationship;
    }

    public function getCoverAttribute(){
        if(!$this->profile_cover_relationship){
            return null;
        }
        return request()->getSchemeAndHttpHost() . "/storage/" . $this->profile_cover_relationship->location;
    }

    public function getProfileCoverAttribute() {
        if(!$this->profile_cover_relationship){
            return null;
        }
        if(is_string($this->profile_cover_relationship->data)){
            $this->profile_cover_relationship->data = json_decode($this->profile_cover_relationship->data);
        }

        return $this->profile_cover_relationship;
    }

    public function otp(){
        return $this->hasOne(OTP::class);
    }


}
