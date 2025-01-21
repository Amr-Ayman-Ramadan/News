<?php

use App\Http\Controllers\Admin\Profile\ProfileController;
use Illuminate\Support\Facades\Notification;
use App\Http\Controllers\Admin\admins\AdminController;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\categories\CategoryController;
use App\Http\Controllers\Admin\Contact\ContactController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\posts\PostController;
use App\Http\Controllers\Admin\roles\RoleController;
use App\Http\Controllers\Admin\users\UserController;
use App\Models\Admin;
use App\Models\Contact;
use App\Notifications\NewContactNotify;
use Illuminate\Support\Facades\Route;



Route::group(["prefix" => "auth/admin", "as" => "auth", "middleware" => "guest"], function () {
    Route::controller(AuthController::class)->group(function () {
        Route::get("/login", "loginPage")->name("loginPage");
        Route::post("/login", "login")->name("login");
        Route::get("forgot-password", "forgotPasswordPage")->name("forgotPasswordPage");
        Route::post("forgot-password", "forgotPassword")->name("forgotPassword");
        Route::get("confirm/{email}", "confirmPage")->name("confirmPage");
        Route::post("confirm/{email}", "verifyOtp")->name("verifyOtp");
        Route::get('reset-password/{email}', "resetPasswordPage")->name('resetPasswordPage');
        Route::post('reset-password', "resetPassword")->name('resetPassword');
    });
});

Route::group(["prefix"=>"admin","as"=>"admin.","middleware"=>"auth"],function(){
    Route::get("/",[DashboardController::class,"index"])->name("dashboard");
    Route::get("logout",[AuthController::class,"logout"])->name("logout");

    Route::resource("users",UserController::class);
    Route::get("users/status/{id}",[UserController::class,"changeStatus"])->name("users.status");

    Route::resource("categories",CategoryController::class);
    Route::get("categories/status/{id}",[CategoryController::class,"changeStatus"])->name("categories.status");

    Route::resource("posts",PostController::class);

    Route::resource("admins",AdminController::class);
    Route::get("admins/status/{id}",[AdminController::class,"changeStatus"])->name("admins.status");

    Route::resource("roles",RoleController::class);

    Route::group(["prefix"=>"contact","as"=>"contact.","middleware"=>"auth"],function(){
        Route::get("/",[ContactController::class,"index"])->name("index");
        Route::get("show/{id}",[ContactController::class,"show"])->name("show");
        Route::delete("destroy/{id}",[ContactController::class,"destroy"])->name("destroy");
    });
    Route::group(["prefix"=>"profile","as"=>"profile.","middleware"=>"auth"],function(){
        Route::get("/",[ProfileController::class,"index"])->name("index");
        Route::put("update",[ProfileController::class,"update"])->name("update");
    });



//    Route::get('/test-notification', function () {
//        $contact = Contact::create([
//            'name' => 'amr ayman',
//            'email' => 'amr@example.com',
//            'title' => 'Test Contact',
//            'body' => 'This is a test contact message.',
//            'phone' => '1234567890',
//            'ip_address' => '127.0.0.1',
//        ]);
//
//        $admin = Admin::get();
//        Notification::send($admin, new NewContactNotify($contact));
//        return back();
//    });

});
