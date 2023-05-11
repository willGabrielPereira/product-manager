<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
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

Route::get('/users', fn () => response()->json(User::get()));

Route::post('/signup', [AuthController::class, 'signup'])->name('signup');

// Route::middleware('auth:sanctum')->group('signed', function () {
    Route::middleware('auth:sanctum')->get('/user', [UserController::class, 'show'])->name('user.show');
    Route::middleware('auth:sanctum')->put('/user/update', [UserController::class, 'update'])->name('user.update');
// });

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
