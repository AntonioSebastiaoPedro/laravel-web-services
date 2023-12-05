<?php

use App\Http\Controllers\Api\CategoryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('categories', [CategoryController::class, 'store'])->name('categories.store');
Route::put('categories/{id}', [CategoryController::class, 'update'])->name('categories.update');
Route::delete('categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');