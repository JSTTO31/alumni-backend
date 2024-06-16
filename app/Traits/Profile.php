<?php

namespace App\Traits;

use App\Models\About;
use App\Models\Certification;
use App\Models\ContactInformation;
use App\Models\Education;
use App\Models\GeneralInformation;
use App\Models\Image;
use App\Models\Link;
use App\Models\PersonalInformation;
use App\Models\Skill;
use App\Models\Student;
use App\Models\Work;

Trait Profile{
    public function about(){
        return $this->hasOne(About::class);
    }

    public function alumni_information(){
        return $this->hasOne(Student::class, 'email', 'email')->with('department');
    }

    public function general_information(){
        return $this->hasOne(GeneralInformation::class);
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
