<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\LikeController;

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


Route::get('/products', [ProductController::class,'get_products']);
Route::get('/categories', [CategoryController::class,'get_category']);


Route::post('/add-feedback', [FeedbackController::class,'save_feedback']);
Route::get('/get-product-feedback', [FeedbackController::class,'get_product_feedback']);
Route::post('/vote-feedback',[LikeController::class,'likeFeedback'])->middleware('auth:sanctum');

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
