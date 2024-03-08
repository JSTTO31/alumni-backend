<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReactionController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TitleParagraphController;
use App\Http\Controllers\ViewController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('user', function(Request $request){
        return $request->user();
    });

    Route::get('user/{user:email}/profiles', ProfileController::class);

    Route::controller(ReactionController::class)->group(function(){
        Route::post('reaction/add', 'add_reaction');
        Route::post('reaction/remove', 'remove_reaction');
        Route::post('reaction/toggle', 'toggle');
    });

    Route::controller(ConnectionController::class)->group(function(){
        Route::post('/user/{user}/connections/request', 'request');
        Route::post('/user/{user}/connections/cancel', 'cancel');
        Route::post('/user/{user}/connections/disconnect', 'disconnect');
        Route::post('/user/{user}/connections/confirm', 'confirm');
        Route::get('/{user:email}/connections', 'connections');
        Route::get('/{user:email}/connection-requests', 'connection_requests');
    });

    Route::controller(PeopleController::class)->group(function(){
        Route::get('/{user:email}/people-you-may-know', 'people_you_may_know');
        Route::get('/{user:email}/batchmates', 'batchmates');
    });

    Route::get('/search', SearchController::class);

    Route::controller(ViewController::class)->group(function(){
        Route::post('/view/profile/{user}', 'profile');
    });

    Route::post('/user/{user}/follows', FollowController::class);



    Route::post('title-paragraphs', [TitleParagraphController::class, 'store']);
    Route::post('informations', [InformationController::class, 'store']);
    Route::apiResource('experiences', ExperienceController::class)->only(['store', 'index']);

    // Route::post('post/{post}/views', ViewController::class);
    Route::apiResource('posts', PostController::class);
    Route::apiResource('post.comments', CommentController::class)->only(['store']);


  
});

Route::post('/login', function(){
    $user = User::find(1);

    return $user->createToken('example-token')->plainTextToken;
});







