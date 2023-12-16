<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Authentication routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/authenticate', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Post CRUD routes
Route::middleware('auth:api')->group(function () {
    Route::get('/me', [AuthController::class, 'getProfile']);
    Route::get('/post-lists', [PostController::class, 'getPostLists']);
    Route::post('/post-create', [PostController::class, 'createPost']);
    Route::get('/post-details/{id}', [PostController::class, 'getPostDetails']);
    Route::post('/post-update/{id}', [PostController::class, 'updatePost']);
    Route::delete('/post-delete/{id}', [PostController::class, 'deletePost']);
});

