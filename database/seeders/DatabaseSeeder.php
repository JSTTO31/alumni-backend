<?php

namespace Database\Seeders;
use Shuchkin\SimpleXLSX;
use App\Models\Comment;
use App\Models\Connection;
use App\Models\Department;
use App\Models\Nationality;
use App\Models\Post;
use App\Models\RequestConnection;
use App\Models\Student;
use App\Models\User;
use App\Models\View;
use Illuminate\Support\Facades\Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // \App\Models\User::factory(500)->create();
        // \App\Models\User::factory(1)->create();

        // User::limit(5)->get()->each(function(User $user){
        //     Post::factory()->has(Comment::factory()->count(5))->count(10)->create([
        //         'user_id' => $user->id,
        //     ]);
        // });

        // View::truncate();
        // $randomUsers =  User::orderBy(DB::raw('RAND()'))->limit(77)->get();

        // User::orderBy(DB::raw('RAND()'))->limit(77)->get()->each(function(User $user) use ($randomUsers){

        //   $randomUsers->each(function(User $user2) use($user){
        //     // if($user->id != $user2->id){
        //     //     RequestConnection::create([
        //     //         'user_id' => $user->id,
        //     //         'request_to' => $user2->id,
        //     //         'requested_at' => now(),
        //     //         'request_accepted_at' => now(),
        //     //     ]);
        //     //     DB::table('connections')->insert([
        //     //         [
        //     //             'user_id' => $user->id,
        //     //             'connected_to' => $user2->id,
        //     //         ],
        //     //         [
        //     //             'user_id' => $user2->id,
        //     //             'connected_to' => $user->id
        //     //         ]
        //     //     ]);
        //     // }

        //     View::create([
        //         'user_id' => $user->id,
        //         'viewable_id' => 1,
        //         'type' => User::class,
        //     ]);

        //   });
        // });


        // User::find(1)->update([
        //     'password' => Hash::make("joshuasotto")
        // ]);


        // View::where('type', 'App\Models\Post')->delete();
        // Student::create();

        // User::where('id', '!=', 1)->delete();

        // $xls = SimpleXLSX::parse((__DIR__ . '/names.xlsx'));


        // $departments = collect(Department::all())->toArray();

        // $data = $xls->rows();

        // $students = collect($data)->map(function($item, $index) use($departments){

        //     $department = collect($departments)->first(fn($item) => $item['name'] == Str::of($item[1])->headline()->value());
        //     $year = explode($item[2]);
        //     return [
        //         'department_id' => $department['id'],
        //         'student_number' =>
        //         'name' =>
        //         'email'
        //     ];
        // });


        // $user = User::where('email', 'joshuasotto@example.example')->first();
        // $user->password = Hash::make('joshuasotto');
        // $user->save();

        // User::all()->each(function($user){
        //     $user->name = fake()->name();
        //     $user->save();
        // });

        $arellanoUniversityBranches = [
            "Legarda Campus",
            "Juan Sumulong Campus",
            "Apolinario Mabini Campus",
            "Andres Bonifacio Campus",
            "Jose Rizal Campus",
            "Elisa Esguerra Campus",
            "Plaridel Campus",
            "Florentino Cayco Memorial School"
          ];


          foreach($arellanoUniversityBranches as $arrelano){
            DB::table('school_branches')->insert(['name' => $arrelano]);
          }

    }
}
