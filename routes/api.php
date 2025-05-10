<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClothesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Authentication routes
Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
Route::post('/login', [AuthenticationController::class, 'login'])->name('login');

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    
    // User management routes (only accessible by Admin)
    Route::get('/get-users', [UserController::class, 'getUsers'])->name('getUsers');
    Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser');
    Route::put('/edit-user/{id}', [UserController::class, 'editUser'])->name('editUser');
    Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

    
Route::get('/clothes', [ClothesController::class, 'getClothes']);
Route::post('/clothes', [ClothesController::class, 'addClothes']);
Route::put('/clothes/{id}', [ClothesController::class, 'editClothes']);
Route::delete('/clothes/{id}', [ClothesController::class, 'deleteClothes']);
    
    // Logout route
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});
