<?php

use App\Http\Controllers\CertificationController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\LinkController;
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
use App\Http\Controllers\ProfileGeneralInformationController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->group(function(){
    Route::get('user/{user:email}/profiles', ProfileIndexController::class);
    Route::apiResource('personal_informations', PersonalInformationController::class)->only(['store', 'update']);
    Route::apiResource('general-informations', ProfileGeneralInformationController::class)->only(['store', 'update']);
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
});
