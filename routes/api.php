<?php

use App\Http\Controllers\ProgressionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommentController;
use App\Models\Categorie;

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
Route::apiResource('blog', BlogController::class);
Route::get('/blog/{id}/animal', [BlogController::class, 'show']);

Route::apiResource('client', ClientController::class);
Route::get('/getClient/{id}', [ClientController::class, 'getClient']);
Route::get('/getClients', [ClientController::class, 'getAll']);

Route::apiResource('comment', CommentController::class);
 Route::post('/blog/{id}/animal/comment', [CommentController::class, 'store'])->name('add_comments');


Route::apiResource('animal', AnimalController::class);
Route::get('/getAnimals', [AnimalController::class, 'getAll']);
Route::get('/getAnimal/{id}', [AnimalController::class, 'getAnimal']);  

Route::apiResource('categorie', CategorieController::class);
Route::apiResource('/user', UserController::class)->middleware('auth:sanctum');

Route::group(['middleware' => ['auth:sanctum']],function(){


   
});

Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

