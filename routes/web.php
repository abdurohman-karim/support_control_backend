<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Blade\RolesController;
use App\Http\Controllers\Blade\PermissionsController;
use App\Http\Controllers\Blade\UserController;

Auth::routes();
Route::group(['middleware'=>"auth"],function (){

    Route::get('/', [HomeController::class,'index'])->name('home');
    # Resources
    Route::resources([
        'permissions' => PermissionsController::class,
        'roles' => RolesController::class,
        'users' => UserController::class
    ]);
});
