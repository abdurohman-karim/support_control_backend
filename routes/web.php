<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Blade\RolesController;
use App\Http\Controllers\Blade\PermissionsController;
use App\Http\Controllers\Blade\UserController;
use App\Http\Controllers\Blade\TaskController;
use App\Http\Controllers\Blade\ChatController;

Auth::routes();
Route::group(['middleware'=>"auth"],function (){

    Route::get('/', [HomeController::class,'index'])->name('home');

    // Tasks
    Route::get('/tasks', [TaskController::class,'index'])->name('tasks.index');
    Route::get('/tasks/{chat_id}', [TaskController::class, 'show_chat'])->name('tasks.group');
    Route::get('/tasks/archives/{chat_id}', [TaskController::class, 'show_archives'])->name('tasks.archives');

    // Tasks (ajax)
    Route::get('/tasks/to-done/{id}', [TaskController::class, 'to_done'])->name('tasks.to-done');
    Route::get('/tasks/to-archived/{id}', [TaskController::class, 'to_archived'])->name('tasks.to-archived');
    Route::get('/tasks/to-delete/{id}', [TaskController::class, 'to_delete'])->name('tasks.to-delete');
    Route::get('/tasks/unzip/{id}', [TaskController::class, 'unzip'])->name('tasks.unzip');

    // Message to chat
    Route::get('/chats', [ChatController::class, 'index'])->name('chats.index');
    Route::post('/chats', [ChatController::class, 'message'])->name('chats.message');


    # Resources
    Route::resources([
        'permissions' => PermissionsController::class,
        'roles' => RolesController::class,
        'users' => UserController::class
    ]);
});
