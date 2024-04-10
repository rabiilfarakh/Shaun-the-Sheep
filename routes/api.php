<?php

use App\Http\Controllers\ProgressionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('animal', AnimalController::class);

Route::group(['middleware' => ['auth:sanctum']],function(){
   
});
 // Route::post('/logout', [UserController::class, 'logout']);
// Route::post('/dashboard', [UserController::class, 'register']);
// Route::post('/register', [UserController::class, 'register']);
// Route::post('/login', [UserController::class, 'login']);

