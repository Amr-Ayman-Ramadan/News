<?php

use App\Http\Controllers\EndUser\Auth\AuthController;
use App\Http\Controllers\EndUser\ContactController;
use App\Http\Controllers\EndUser\CategoryController;
use App\Http\Controllers\EndUser\Dashboard\NotificationController;
use App\Http\Controllers\EndUser\Dashboard\ProfileController;
use App\Http\Controllers\EndUser\HomeController;
use App\Http\Controllers\EndUser\NewSubscriberController;
use App\Http\Controllers\EndUser\PostController;
use App\Http\Controllers\EndUser\SearchController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function () {
    Route::controller(AuthController::class)->group(function () {

        Route::get("register", 'registerPage')->name('registerPage');
        Route::post("register", 'register')->name('register');
        Route::get("login", 'loginPage')->name('loginPage');
        Route::post("login", 'login')->name('login');

        Route::get("logout", 'logout')->name('logout')->middleware('auth');

        Route::get("forgot-password", 'forgotPasswordPage')->name('forgotPasswordPage');
        Route::post("forgot-password", 'forgotPassword')->name('forgotPassword');
        Route::get("reset-password/{token}", 'resetPasswordPage')->name('resetPasswordPage');
        Route::post("reset-password", 'resetPassword')->name('resetPassword');
    });
});

Route::group(['as' => 'endUser.'], function () {
    // Home Route
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Subscriber Routes
    Route::group(['prefix' => 'subscriber', 'as' => 'subscriber.'], function () {
        Route::post("store", [NewSubscriberController::class, 'store'])->name('store');
    });

    // Category Routes
    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get("{slug}", CategoryController::class)->name('posts');
    });

    // Post Routes
    Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
        Route::controller(PostController::class)->group(function () {
            Route::get("{slug}", "show")->name('show');
            Route::get("comments/{slug}", 'getAllComments')->name('comments');
            Route::post("comments/save", 'storeComment')->name('comments.store');
        });
    });

    // Contact Routes
    Route::group(['prefix' => 'contact', 'as' => 'contact.'], function () {
        Route::controller(ContactController::class)->group(function () {
            Route::get("us", 'index')->name('index');
            Route::post("store", 'store')->name('store');
        });
    });

    // Search Routes
    Route::group(['prefix' => 'search', 'as' => 'search.'], function () {
        Route::post("/", SearchController::class)->name('index');
    });
    // User Dashboard
    Route::prefix("account/")->name("dashboard.")->middleware(["auth","verified"])->group(function () {
        // Profile
        Route::controller(ProfileController::class)->group(function () {
            Route::get("profile", 'index')->name('profile');
            Route::post("post/store", 'store')->name('post.store');
            Route::get("post/edit/{slug}", 'edit')->name('post.edit');
            Route::delete("post/delete", 'destroy')->name('post.destroy');
        });
        // notifications
        Route::prefix("notifications")->name("notifications.")->group(function () {
            Route::controller(NotificationController::class)->group(function () {
                Route::get("notifications", 'index')->name('index');
                Route::get("markAsRead", 'markAsRead')->name('markAsRead');
                Route::delete("notifications/delete", 'destroy')->name('destroy');
            });
        });
    });
});


