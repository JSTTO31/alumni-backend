<?php

use App\Http\Controllers\Comment\HideController as CommentHideController;
use App\Http\Controllers\Comment\IndexController;
use App\Http\Controllers\Comment\ReactionController as CommentReactionController;
use App\Http\Controllers\Comment\ReportController as CommentReportController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\HideController;
use App\Http\Controllers\Post\IndexController as PostIndexController;
use App\Http\Controllers\Post\ReactionController;
use App\Http\Controllers\Post\ReportController;
use App\Http\Controllers\Post\TextController;
use App\Http\Controllers\ReplyController;
use Illuminate\Support\Facades\Route;

Route::middleware("auth:sanctum")->group(function(){
    Route::apiResource('/posts', PostIndexController::class)->only(['index', 'show', 'destroy']);
    Route::apiResource('post.reactions', ReactionController::class)->only(['destroy', 'store']);
    Route::apiResource('post.comments', IndexController::class)->only(['store', 'index', 'destroy']);
    Route::apiResource('post.hides', HideController::class)->only(['store', 'destroy']);
    Route::post('post/{post}/reports', [ReportController::class, 'store']);
    Route::apiResource('comment.reactions', CommentReactionController::class)->only(['destroy', 'store']);
    Route::apiResource('comment.hides', CommentHideController::class)->only(['destroy', 'store']);
    Route::apiResource('comment.reports', CommentReportController::class)->only(['store']);
    Route::apiResource('comment.replies', ReplyController::class)->only(['index', 'store', 'destroy']);

    Route::controller(CreateController::class)->group(function(){
        Route::post('post/texts', 'text');
        Route::post('post/{post}/shares', 'share');
    });
       // Route::post('post/{post}/views', ViewController::class);
    // Route::apiResource('posts', PostController::class);

});
