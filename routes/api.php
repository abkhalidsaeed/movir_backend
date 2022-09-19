<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\AuthController;
use App\Http\Controllers\movie\MovieController;

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

Route::middleware(['CheckAuth:api'])->group(function() {
    Route::get('movies/create', [MovieController::class, 'create']);
    Route::post('movies', [MovieController::class, 'store']);
    Route::get('movies/{id}/edit', [MovieController::class, 'edit']);
    Route::Put('movies/{id}/update', [MovieController::class, 'update']);
    Route::delete('movies/{id}', [MovieController::class, 'destroy']);
    Route::post('logout', [AuthController::class, 'logout']);
});
