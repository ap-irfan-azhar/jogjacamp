<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\Api\CategoryController;

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

Route::get('/categories', [CategoryController::class, 'index'])->name('api.categories.index');
Route::get('/categories/{id}', [CategoryController::class, 'show'])->name('api.categories.show');
Route::post('/categories', [CategoryController::class, 'store'])->name('api.categories.store');
Route::put('/categories/{id}', [CategoryController::class, 'update'])->name('api.categories.update');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('api.categories.destroy');
