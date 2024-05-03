<?php

use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\panier_animalController;

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


Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::apiResource('/user', UserController::class);
    Route::post('/logout', [UserController::class, 'logout']);

    Route::apiResource('client', ClientController::class);
    Route::get('/getClient/{id}', [ClientController::class, 'getClient']);
    Route::get('/getClients', [ClientController::class, 'getAll']);

    Route::apiResource('comment', CommentController::class);
    Route::post('/blog/{id}/animal/comment', [CommentController::class, 'store'])->name('add_comments');

    //cart
    Route::apiResource('/product/panier', PanierController::class);
    Route::post('/panier', [PanierController::class, 'getProductClient']);
    Route::post('/product/panier_exist', [PanierController::class, 'panier_exist']);

    Route::apiResource('animal', AnimalController::class);
    Route::get('/getAnimals', [AnimalController::class, 'getAll']);
    Route::get('/getAnimal/{id}', [AnimalController::class, 'getAnimal']);  

    Route::apiResource('categorie', CategorieController::class);
    Route::apiResource('/user', UserController::class)->middleware('auth:sanctum');

    Route::apiResource('blog', BlogController::class);
    Route::get('/blog/{id}/animal', [BlogController::class, 'show']);

    //commande 
    Route::apiResource( '/panier/commande', CommandeController::class );
    Route::post( '/product/panier/deleteA', [PanierController::class, 'destroyA'] );
    Route::post('/panier/getCommande', [CommandeController::class, 'getCommande']);

    Route::post('/panier/commande/deleteStatus', [CommandeController::class, 'deleteStatus']);

});


Route::post('/logout', [UserController::class, 'logout']);
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

