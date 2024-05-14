<?php

use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CategoryController;
use App\Http\Controllers\Dashboard\FavoriteController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [FavoriteController::class, 'index'])->name('welcome');

require __DIR__ . '/auth.php';

Route::middleware('is_admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    
    });
    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });



// ----------------------- USER ----------------------------------
Route::get('/users', [UserController::class, 'index'])->name('user.index');
Route::get('/users/create', [UserController::class, 'create'])->name('user.add');
Route::post('/users', [UserController::class, 'store'])->name('user.store');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.delete');


// ----------------------- Role ----------------------------------
Route::get('/roles', [RoleController::class, 'index'])->name('role.index');
Route::get('/roles/create', [RoleController::class, 'create'])->name('role.add');
Route::post('/roles', [RoleController::class, 'store'])->name('role.store');
Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('role.edit');
Route::put('/roles/{role}', [RoleController::class, 'update'])->name('role.update');
Route::delete('/roles/{role}', [RoleController::class, 'destroy'])->name('role.delete');
Route::get('/roles/trashed', [RoleController::class, 'trashed'])->name('role.trashed');
Route::get('roles/restore/{id}', [RoleController::class, 'restore'])->name('role.restore');
Route::delete('roles/force-delete/{id}', [RoleController::class, 'forceDelete'])->name('role.force_delete');
Route::put('/roles/{role}/assign-permission/{id}', [RoleController::class, 'assignPermission'])->name('role.assign-permission');
Route::put('/roles/{role}/revoke-permission/{id}', [RoleController::class, 'revokePermission'])->name('role.revoke-permission');


// ----------------------- Categories ----------------------------------
Route::get('/categories', [CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('category.add');
Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/categroies/{category}', [CategoryController::class, 'destroy'])->name('category.delete');


// ----------------------- Books ----------------------------------
Route::get('/books', [BookController::class, 'index'])->name('book.index');
Route::get('/books/create', [BookController::class, 'create'])->name('book.create');
Route::post('/books', [BookController::class, 'store'])->name('book.store');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('book.edit');
Route::put('/books/{id}', [BookController::class, 'update'])->name('book.update');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('book.delete');


// ----------------------- Favorites ----------------------------------
Route::get('/add-favorites/{user_id}/{book_id}', [FavoriteController::class, 'addFavorite'] )->name('addFavorite')->middleware('auth');
Route::get('/remove-favorites/{user_id}/{book_id}', [FavoriteController::class, 'removeFavorite'] )->name('removeFavorite')->middleware('auth');
Route::get('/favorites/{user_id}' ,[ FavoriteController::class, 'favorite'])->name('favorites');
