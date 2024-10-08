<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\MainController;
use App\Http\Controllers\Api\TaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/switch-theme',function (Request $request){
    $user = \App\Models\User::find($request->user_id);
    return $user->switchTheme();
})->name('switchTheme');

Route::post('/task-create', [TaskController::class, 'store'])->name('tasks.create');
