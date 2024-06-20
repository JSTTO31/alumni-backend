<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Connection;
use App\Models\RequestConnection;

class UserEngagement extends Seeder
{

    public  $user;
    public  $users;

    public function __construct()
    {
        $this->user = User::find(1);
        $this->users = User::where('id', '<>', 1)->limit(25)->get();
    }

    public function addViews(){
        $container = collect($this->users)->map(fn($item) => ['user_id' => $item['id']]);
        $this->user->views()->createMany($container);
    }

    public function addRequestConnection(){
        foreach($this->users as $usr){
            $usr->requestConnection($this->user);
        }
    }


    public function run(): void
    {
        $this->addRequestConnection();
    }
}
