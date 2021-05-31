<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;


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
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('signup', [ AuthController::class,'signup']);
    Route::post('login',  [ AuthController::class, 'login']);
    Route::post('logout', [ AuthController::class, 'logout']);
});

Route::post('task', [TaskController::class, 'createTask']);
Route::get('task', [TaskController::class, 'showtask']);
Route::get('task/{id}', [TaskController::class, 'getTaskbyId']);
Route::put('task/{id}', [TaskController::class, 'updateTask']);
Route::delete('task/{id}', [TaskController::class, 'deleteTask']);
