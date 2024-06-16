<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Certification;
use App\Models\ContactInformation;
use App\Models\Education;
use App\Models\GeneralInformation;
use App\Models\Image;
use App\Models\Link;
use App\Models\PersonalInformation;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfileReset extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::whereDate('created_at', now()->today())->delete();
        PersonalInformation::whereDate('created_at', now()->today())->delete();
        ContactInformation::whereDate('created_at', now()->today())->delete();
        GeneralInformation::whereDate('created_at', now()->today())->delete();
        Image::whereDate('created_at', now()->today())->delete();
        Link::whereDate('created_at', now()->today())->delete();
        About::whereDate('created_at', now()->today())->delete();
        Certification::whereDate('created_at', now()->today())->delete();
        Skill::whereDate('created_at', now()->today())->delete();
        Education::whereDate('created_at', now()->today())->delete();
        Work::whereDate('created_at', now()->today())->delete();
    }
}
