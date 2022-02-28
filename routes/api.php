<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\User;

use App\Http\Controllers\ProductsController;
use Illuminate\Http\Request;
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
// Route::resource('products', ProductsController::class);

// Public Routes
Route::get('/allUsers',[AuthController::class, 'user']);
Route::post('/register',[AuthController::class, 'register']);
Route::post('/login',[AuthController::class, 'login']);
Route::get('/products',[ProductsController::class, 'index']);
Route::get('/products/{id}',[ProductsController::class, 'show']);
Route::get('/products/search/{query}',[ProductsController::class, 'search']);

// Protected ROutes
Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/products',[ProductsController::class, 'store']);
    Route::put('/products/{id}',[ProductsController::class, 'update']);
    Route::delete('/products/{id}',[ProductsController::class, 'destroy']);
    Route::post('/logout',[AuthController::class, 'logout']);
});



Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
