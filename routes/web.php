<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin', function () {
        dd('loshara');
    })->name('admin.dashboard');
    Route::prefix('admin')->group(function () {
        Route::resource('recipes', \App\Http\Controllers\RecipeController::class);
        Route::resource('categories', \App\Http\Controllers\CategoryController::class);
        Route::resource('ingredients', \App\Http\Controllers\IngredientController::class);
    });
});
