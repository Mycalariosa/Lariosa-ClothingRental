<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ClothesController;
use App\Http\Controllers\RentalAppController;
use App\Http\Controllers\RentalStatusController;
use App\Http\Controllers\UserStatusController;

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

// User management routes
Route::get('/get-users', [UserController::class, 'getUsers'])->name('getUsers');
Route::post('/add-user', [UserController::class, 'addUser'])->name('addUser');
Route::put('/edit-user/{id}', [UserController::class, 'editUser'])->name('editUser');
Route::delete('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('deleteUser');

// Clothes routes
Route::get('/clothes', [ClothesController::class, 'getClothes']);
Route::post('/clothes', [ClothesController::class, 'addClothes']);
Route::put('/clothes/{id}', [ClothesController::class, 'editClothes']);
Route::delete('/clothes/{id}', [ClothesController::class, 'deleteClothes']);

// Rental appointment routes
Route::get('/rentals', [RentalAppController::class, 'getRentals']);
Route::post('/rentals', [RentalAppController::class, 'addRental']);
Route::put('/rentals/{id}', [RentalAppController::class, 'editRental']);
Route::delete('/rentals/{id}', [RentalAppController::class, 'deleteRental']);

// Rental status routes
Route::get('/rental-statuses', [RentalStatusController::class, 'getRentalStatuses']);
Route::post('/rental-statuses', [RentalStatusController::class, 'addRentalStatus']);
Route::put('/rental-statuses/{id}', [RentalStatusController::class, 'editRentalStatus']);
Route::delete('/rental-statuses/{id}', [RentalStatusController::class, 'deleteRentalStatus']);

// User status routes
Route::get('/user-statuses', [UserStatusController::class, 'getUserStatuses']);
Route::post('/user-statuses', [UserStatusController::class, 'addUserStatus']);
Route::put('/user-statuses/{id}', [UserStatusController::class, 'editUserStatus']);
Route::delete('/user-statuses/{id}', [UserStatusController::class, 'deleteUserStatus']);

// Protected routes (authentication required)
Route::middleware('auth:sanctum')->group(function () {
    // Logout route
    Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
});
