<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', function () {
    return response()->json(['message' => 'hi']);
})->name('index');
Route::get('/routes', RouteController::class)->name('routes');



Route::post('/signup', [AuthController::class, 'signup'])->name('signup');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');


Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/category', [CategoryController::class, 'index'])->name('category.index');



Route::name('signed.')->middleware('auth:sanctum')->group(function () {
    // User routes
    Route::name('user.')->prefix('/user')->group(function () {
        Route::get('/', [UserController::class, 'show'])->name('show');
        Route::put('/update', [UserController::class, 'update'])->name('update');

        Route::apiResource('address', AddressController::class);
        Route::apiResource('payment', PaymentController::class);
    });

    Route::name('manager.')->middleware('manager')->group(function () {
        Route::apiResource('category', CategoryController::class)->except('index');
        // Route::apiResource('categories', CategoryController::class);
    });
});
