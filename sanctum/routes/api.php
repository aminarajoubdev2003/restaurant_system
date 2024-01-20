<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
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
Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);

Route::get('/restaurant/all',[RestaurantController::class,'index'])->middleware('auth:sanctum');
Route::get('/restaurant/one/{id}',[RestaurantController::class,'show'])->middleware('auth:sanctum');
Route::get('/restaurant/search/{type}/{address}',[RestaurantController::class,'search_restaurant'])->middleware('auth:sanctum');

Route::post('/addcustomer',[CustomerController::class,'store'])->middleware('auth:sanctum');
Route::post('/addorder',[OrderController::class,'store'])->middleware('auth:sanctum');
Route::post('/additems',[OrderItemController::class,'store'])->middleware('auth:sanctum');
Route::get('/orders/{id}',[OrderController::class,'index'])->middleware('auth:sanctum');