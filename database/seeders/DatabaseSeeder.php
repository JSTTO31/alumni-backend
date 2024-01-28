<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Connection;
use App\Models\Department;
use App\Models\Post;
use App\Models\RequestConnection;
use App\Models\Student;
use App\Models\User;
use App\Models\View;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(500)->create();
        // \App\Models\User::factory(1)->create();

        User::limit(5)->get()->each(function(User $user){
            Post::factory()->has(Comment::factory()->count(5))->count(10)->create([
                'user_id' => $user->id,
            ]);
        });

        // View::truncate();
        // $randomUsers =  User::orderBy(DB::raw('RAND()'))->limit(77)->get();

        // User::orderBy(DB::raw('RAND()'))->limit(77)->get()->each(function(User $user) use ($randomUsers){

        //   $randomUsers->each(function(User $user2) use($user){
        //     if($user->id != $user2->id){
        //         RequestConnection::create([
        //             'user_id' => $user->id,
        //             'request_to' => $user2->id,
        //             'requested_at' => now(),
        //             'request_accepted_at' => now(),
        //         ]);
        //         DB::table('connections')->insert([
        //             [
        //                 'user_id' => $user->id,
        //                 'connected_to' => $user2->id,
        //             ],
        //             [
        //                 'user_id' => $user2->id,
        //                 'connected_to' => $user->id,
        //             ]
        //         ]);
        //     }

        //     // View::create([
        //     //     'user_id' => $user->id,
        //     //     'viewable_id' => 1,
        //     //     'type' => User::class,
        //     // ]);

        //   });
        // });
    }
}
