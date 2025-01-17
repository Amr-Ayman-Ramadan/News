<?php

use App\Http\Controllers\EndUser\CategoryController;
use App\Http\Controllers\EndUser\HomeController;
use App\Http\Controllers\EndUser\NewSubscriberController;
use App\Http\Controllers\EndUser\PostController;
use Illuminate\Support\Facades\Route;


Route::group(['as'=>'endUser.'],function(){
        Route::get('/',[HomeController::class,'index'])->name('home');
        Route::post("news-subscribe",[NewSubscriberController::class,'store'])->name('subscriber.store');
        Route::get("category/{slug}",CategoryController::class)->name('category.posts');
        Route::get("post/{slug}",[PostController::class,'show'])->name('post.show');
        Route::get("post/comments/{slug}",[PostController::class,'getAllComments'])->name('post.comments');
        Route::post("post/comments/save",[PostController::class,'storeComment'])->name('post.comments.store');
    });

