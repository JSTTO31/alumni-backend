<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmailVerificationController;
use App\Http\Controllers\PeopleController;
use App\Http\Controllers\Post\SaveController;
use App\Http\Controllers\SchoolBranchesController;
use App\Http\Controllers\SearchController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('user', function(Request $request){
        return $request->user();
    });

    Route::controller(PeopleController::class)->group(function(){
        Route::get('/people-you-may-know', 'people_you_may_know');
        Route::get('/{user:email}/batchmates', 'batchmates');
    });

    Route::get('/search', SearchController::class);
    Route::get('/departments', [DepartmentController::class, 'index']);
    Route::get('/school_branches', [SchoolBranchesController::class, 'index']);

    Route::controller(EmailVerificationController::class)->group(function () {
        Route::post('/email/verification/send', 'sendVerification');
        Route::post('/email/verification/verify', 'verify');
    });

    Route::apiResource('post.saves', SaveController::class)->only(['store', 'destroy']);
});


require __DIR__ . "/api/profile.php";
require __DIR__ . "/api/post.php";

Route::post('/login', function(){
    $user = User::find(1);
    return $user->createToken('example-token')->plainTextToken;
});

Route::post('/register', [RegisteredUserController::class, 'store']);







