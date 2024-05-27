<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Traits\Connection;
use App\Traits\Viewable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Overtrue\LaravelFollow\Traits\Followable;
use Overtrue\LaravelFollow\Traits\Follower;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Follower, Followable, Connection, Viewable;

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

    public function about(){
        return $this->hasOne(About::class);
    }

    public function informations(){
        return $this->hasMany(information::class);
    }

    public function alumni_information(){
        return $this->hasOne(Student::class, 'email', 'email')->with('department');
    }

    public function personal_information(){
        return $this->hasOne(PersonalInformation::class);
    }

    public function contact_information(){
        return $this->hasOne(ContactInformation::class);
    }

    public function work(){
        return $this->hasOne(Work::class)->where('current', true);
    }

    public function works(){
        return $this->hasMany(Work::class);
    }

    public function skills(){
        return $this->hasMany(Skill::class);
    }

    public function educations(){
        return $this->hasMany(Education::class);
    }

    public function certifications(){
        return $this->hasMany(Certification::class);
    }

    public function images(){
        return $this->morphMany(Image::class, 'imageable')->where('type', 'portfolio');
    }

    public function links(){
        return $this->hasMany(Link::class);
    }
}
