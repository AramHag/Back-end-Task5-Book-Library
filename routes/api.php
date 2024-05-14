<?php

use App\Http\Controllers\Api\V1\BookController;
use App\Http\Controllers\Api\V1\CategoryController;
use App\Http\Controllers\Api\V1\RoleController;
use App\Http\Controllers\Api\V1\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// =========================   Users   =====================
Route::get('users', [UserController::class, 'index']);
Route::post('users', [UserController::class, 'store']);
Route::delete('users/{id}', [UserController::class, 'destroy']);

// =========================   Roles   =====================
Route::get('roles', [RoleController::class, 'index']);
Route::post('roles', [RoleController::class, 'store']);
Route::put('roles/{id}', [RoleController::class, 'update']);
Route::delete('roles/{id}', [RoleController::class, 'destroy']);
Route::get('/roles/trashed', [RoleController::class, 'trashed']);
Route::get('roles/restore/{id}', [RoleController::class, 'restore']);
Route::delete('roles/force-delete/{id}', [RoleController::class, 'forceDelete']);


// =========================   Categories   =====================
Route::get('categories' , [CategoryController::class, 'index']);
Route::post('categories' , [CategoryController::class, 'store']);
Route::put('categories/{id}' , [CategoryController::class, 'update']);
Route::delete('categories/{id}' , [CategoryController::class, 'destroy']);

// =========================   Books    ========================
Route::get('books' , [BookController::class, 'index']);
Route::post('books' , [BookController::class, 'store']);
Route::put('books/{id}' , [BookController::class, 'update']);
Route::delete('books/{id}' , [BookController::class, 'destroy']);

