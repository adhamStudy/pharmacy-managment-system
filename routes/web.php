<?php

use App\Http\Controllers\CancelOrder;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AdminController;

Route::get('/', [HomeController::class, 'index'])->name('welcome')->middleware('auth');
Route::get('/products',[ProductController::class,'index'])->name('products')->middleware('auth');
Route::get('/products/filter', [ProductController::class, 'filter'])->middleware('auth');


Route::get('/admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard')->middleware('admin');
Route::put('/admin/{user}/activate', [AdminController::class, 'activate'])->name('admin.activate');
Route::put('/admin/{user}/deactivate', [AdminController::class, 'deactivate'])->name('admin.deactivate');



Route::get('/reports',[ReportController::class,'sales'])->name('reports')->middleware('auth');
Route::get('/reports.sales',[ReportController::class,'sales'])->name('sales')->middleware('auth');
Route::get('/reports.salesOfMonth',[ReportController::class,'salesOfMonth'])->name('salesOfMonth')->middleware('auth');

Route::get('/reports/searchByOrderId', [ReportController::class, 'searchByOrderId'])
    ->name('searchByOrderId')
    ->middleware('auth');
    
    Route::get('/reports.employees',[ReportController::class,'employees'])->name('employees')->middleware('auth');
Route::get('/reports.products_page',[ProductController::class,'productsExpireDate3Month'])->name('products_page')->middleware('auth');
Route::get('/reports/order/{order}', [ReportController::class, 'show'])->name('reports.order.details');

Route::get('/cancel',[CancelOrder::class,'index'])->name('cancel')->middleware('auth');
Route::get('/cancel/cancelOrder', [CancelOrder::class, 'cancelOrder'])->name('cancelOrder')->middleware('auth');
Route::post('/cancel/CompleteCancelMedicine', [CancelOrder::class, 'CompleteCancelMedicine'])->name('CompleteCancelMedicine')->middleware('auth');


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
