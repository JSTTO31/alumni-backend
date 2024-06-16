<?php

namespace Database\Seeders;

use App\Models\About;
use App\Models\Certification;
use App\Models\ContactInformation;
use App\Models\Department;
use App\Models\Education;
use App\Models\GeneralInformation;
use App\Models\Image;
use App\Models\Link;
use App\Models\PersonalInformation;
use App\Models\SchoolBranch;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Profile extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 50; $i++) {
            DB::transaction(function(){
                $gender = fake()->randomElement(['male', 'female']);
                $first_name = fake()->firstName($gender);
                $last_name = fake()->lastName();
                $name = $first_name . " " . $last_name;
                $email = fake()->unique()->safeEmail();
                $password = Hash::make('password');

                $user = User::create([
                    'name' => $name,
                    'email' => $email,
                    'email_verified_at' => now(),
                    'verified_at' => now(),
                    'password' => $password,
                    'remember_token' => Str::random(10),
                ]);

                PersonalInformation::factory()->create([
                    'user_id' => $user->id,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'gender' => $gender,
                ]);

                ContactInformation::factory()->create([
                    'user_id' => $user->id,
                ]);

                GeneralInformation::factory()->create(['user_id' => $user->id]);
                About::factory()->create(['user_id' => $user->id]);

                // Profile Picture
                Image::factory()->create([
                    'imageable_id' => $user->id,
                    'imageable_type' => User::class,
                    'data' => "{\"styles\":{\"scale\":0},\"selected_frame\":1}",
                    'type' => 'profile',
                    'location' => ($gender == 'male' ? 'dummy/male' : 'dummy/female')  . ".png"
                ]);

                // Cover Picture
                Image::factory()->create([
                    'imageable_id' => $user->id,
                    'imageable_type' => User::class,
                    'type' => 'cover',
                    'data' => "{\"styles\":{\"translateY\":50}}",
                    'location' => 'dummy/cover-' . rand(1, 10) . ".jpg"
                ]);

                for ($i=0; $i < 4; $i++) {
                    Skill::factory()->create(['user_id' => $user->id]);
                    Work::factory()->create(['user_id' => $user->id]);
                    Education::factory()->create(['user_id' => $user->id]);
                    Certification::factory()->create(['user_id' => $user->id]);
                    Link::factory()->create(['user_id' => $user->id]);
                    Image::factory()->create(['imageable_id' => $user->id, 'imageable_type' => User::class]);
                }
            });

        }
    }
}
