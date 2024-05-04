<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PostController;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//return $request->user();
//});


// Route::get('/posts', [PostController::class, 'index']);
// Route::middleware(['auth:api'])->group(function () {
//     Route::resource('posts', PostController::class);
// });





Route::get('/posts', [PostController::class, 'index']);


// Route::middleware(['api'])->group(function () {
//     Route::controller(AuthController::class)->group(function () {
//         Route::post('login', 'login');
//         Route::post('register', 'register');
//         Route::post('refresh', 'refresh');
//         Route::post('logout', 'logout');
//     });
//     Route::middleware(['jwt.verify'])->group(function () {
//         // Route::resource('posts', PostController::class);
//         Route::get('/posts', [PostController::class, 'index']);
//         Route::get('/posts/{id}', [PostController::class, 'show']);
//         Route::post('/posts', [PostController::class, 'store']);
//         Route::post('/post/{id}', [PostController::class, 'update']);
//         Route::get('/post/{id}', [PostController::class, 'destroy']);

//     });
// });
Route::middleware(['api'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        Route::post('login', 'login');
        Route::post('register', 'register');
        Route::post('refresh', 'refresh');
        Route::post('logout', 'logout');
    });
    Route::middleware(['jwt.verify'])->group(function () {
        Route::get('/posts', [PostController::class, 'index']);
        Route::get('/posts/{id}', [PostController::class, 'show']);
        Route::post('/posts', [PostController::class, 'store']);
        Route::post('/post/{id}', [PostController::class, 'update']);
        Route::get('/post/{id}', [PostController::class, 'destroy']);
    });
});
