<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\movie\MovieController;
use App\Http\Controllers\genre\GenreController;

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

Route::post('login', [AuthController::class, 'login']);
Route::post('registration', [AuthController::class, 'registration']);

Route::get('movies',[MovieController::class,'index']);
Route::get('movies/{id}/show',[MovieController::class,'show']);

Route::get('genres',[GenreController::class,'index']);
Route::get('genres/{id}/show',[GenreController::class,'show']);

Route::middleware(['CheckAuth:api'])->group(function() {
    Route::get('movies', [MovieController::class, 'create']);
    Route::post('movies', [MovieController::class, 'store']);
    Route::get('movies/{id}', [MovieController::class, 'edit']);
    Route::Put('movies/{id}', [MovieController::class, 'update']);
    Route::delete('movies/{id}', [MovieController::class, 'destroy']);
    Route::get('genres', [GenreController::class, 'create']);
    Route::post('genres', [GenreController::class, 'store']);
    Route::get('genres/{id}', [GenreController::class, 'edit']);
    Route::Put('genres/{id}', [GenreController::class, 'update']);
    Route::delete('genres/{id}', [GenreController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});
