<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
Route::get('/', [HomeController::class, 'index'])->name('welcome');

Route::post('search', [HomeController::class, 'search'])->name('search');
Route::post('/add_to_cart', [HomeController::class, 'addToCart'])->name('add_to_cart');
Route::get('/completePurchase',[HomeController::class,'completePurchase'])->name('completePurchase');
Route::get('/order/{order}', [OrderController::class, 'show'])->name('order.details');
// In web.php
Route::delete('/remove_from_cart/{medicineId}', [HomeController::class, 'removeFromCart'])->name('remove_from_cart');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
