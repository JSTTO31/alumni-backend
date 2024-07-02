<?php

use App\Http\Controllers\ConnectionController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\PersonRemoveController;
use App\Http\Controllers\Profile\AboutController as ProfileAboutController;
use App\Http\Controllers\Profile\CertificationController as ProfileCertificationController;
use App\Http\Controllers\Profile\ContactInformationController as ProfileContactInformationController;
use App\Http\Controllers\Profile\CoverController;
use App\Http\Controllers\Profile\EducationController as ProfileEducationController;
use App\Http\Controllers\Profile\ExperienceController;
use App\Http\Controllers\Profile\ImageController;
use App\Http\Controllers\Profile\IndexController as ProfileIndexController;
use App\Http\Controllers\Profile\LinkController as ProfileLinkController;
use App\Http\Controllers\Profile\PersonalInformationController;
use App\Http\Controllers\Profile\PictureController;
use App\Http\Controllers\Profile\SkillController;
use App\Http\Controllers\Profile\WorkController;
use App\Http\Controllers\Profile\GeneralInformationController;
use App\Http\Controllers\ViewController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->group(function(){
    Route::get('user/{user:email}/profiles', ProfileIndexController::class);
    Route::apiResource('personal_informations', PersonalInformationController::class)->only(['store', 'update']);
    Route::apiResource('general-informations', GeneralInformationController::class)->only(['store', 'update']);
    Route::apiResource('contact_informations', ProfileContactInformationController::class)->only(['store', 'update']);
    Route::apiResource('works', WorkController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('skills', SkillController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('educations', ProfileEducationController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('certifications', ProfileCertificationController::class)->only(['store', 'update', 'destroy']);
    Route::apiResource('images', ImageController::class)->only(['store', 'destroy', 'update']);
    Route::post('images/{image}/update', [ImageController::class, 'update']);
    Route::apiResource('links', ProfileLinkController::class)->only(['store', 'update', 'destroy']);
    Route::post('abouts', ProfileAboutController::class);
    Route::apiResource('experiences', ExperienceController::class)->only(['store', 'index']);
    Route::post('pictures', PictureController::class);
    Route::post('covers', CoverController::class);

    Route::controller(ViewController::class)->group(function(){
        Route::post('/view/profile/{user}', 'profile');
    });

    Route::controller(ConnectionController::class)->group(function(){
        Route::post('/user/{user}/connections/request', 'request');
        Route::post('/user/{user}/connections/cancel', 'cancel');
        Route::post('/user/{user}/connections/disconnect', 'disconnect');
        Route::post('/user/{user}/connections/confirm', 'confirm');
        Route::get('/{user:email}/connections', 'connections');
        Route::get('connection-requests', 'connection_requests');
    });

    Route::post('/user/{user}/follows', FollowController::class);

    Route::delete('/{user:email}/removes', PersonRemoveController::class);


});
