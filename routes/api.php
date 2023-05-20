<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\TopicController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CategoryController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::get('user/{id}', [UserController::class, 'getUser']);

Route::get('topics/lasted_activity', [TopicController::class, 'getLastActivity']);
Route::resource('topics', TopicController::class)->except(
    ['store', 'edit', 'destroy', 'update']
);
Route::resource('category', CategoryController::class)->except(
    ['store', 'edit', 'destroy', 'update']
);

Route::resource('posts', PostController::class)->except(
    ['store', 'edit', 'destroy', 'update']
);


Route::middleware('auth:api')->group(function () {

    Route::get('user', [UserController::class, 'index']);


    Route::resource('topics', TopicController::class)->except(
        ['index', 'show']
    );
    Route::resource('category', CategoryController::class)->except(
        ['index', 'show']
    );
    Route::resource('posts', PostController::class)->except(
        ['index', 'show']
    );
});
