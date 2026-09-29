<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CashAccountController;
use App\Http\Controllers\InvoiceProjectController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionQueueController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\SupplierController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::resource('customers', CustomerController::class);

Route::resource('cash-accounts', CashAccountController::class);

Route::get(
    '/invoice-project',
    [InvoiceProjectController::class, 'index']
)->name('invoice-project.index');

Route::get(
    '/invoice-project/{order}',
    [InvoiceProjectController::class, 'show']
)->name('invoice-project.show');

Route::get(
    '/invoice-project/{order}/print',
    [InvoiceProjectController::class, 'print']
)->name('invoice-project.print');

Route::resource('orders', OrderController::class);

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

Route::resource(
    'purchases',
    PurchaseController::class
);

Route::get(
    '/receivables',
    [ReceivableController::class, 'index']
)->name('receivables.index');

Route::get(
    '/receivables/{order}',
    [ReceivableController::class, 'show']
)->name('receivables.show');

Route::post(
    '/receivables/{order}/pay',
    [ReceivableController::class, 'pay']
)->name('receivables.pay');

Route::resource('suppliers', SupplierController::class);