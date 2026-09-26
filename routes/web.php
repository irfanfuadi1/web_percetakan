<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CashAccountController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionQueueController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::resource('customers', CustomerController::class);

Route::resource('cash-accounts', CashAccountController::class);

Route::resource('products', ProductController::class);

Route::patch(
    'production-queues/{productionQueue}/complete',
    [ProductionQueueController::class, 'complete']
)->name('production-queues.complete');

Route::get(
    'production-queues/{productionQueue}/download',
    [ProductionQueueController::class, 'download']
)->name('production-queues.download');

Route::get(
    '/production-queues',
    [ProductionQueueController::class, 'index']
)->name('production-queues.index');

Route::resource('suppliers', SupplierController::class);