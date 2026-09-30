<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CashAccountController;
use App\Http\Controllers\CashFlowReportController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\InvoiceProjectController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionQueueController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseReportController;
use App\Http\Controllers\ProfitLossReportController;
use App\Http\Controllers\PayableReportController;
use App\Http\Controllers\ReceivableController;
use App\Http\Controllers\ReceivableReportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SalesReportController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\UserManagementController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('categories', CategoryController::class);

Route::resource('customers', CustomerController::class);

Route::resource('cash-accounts', CashAccountController::class);

Route::get(
    '/reports/cash-flow',
    [CashFlowReportController::class, 'index']
)->name('reports.cash-flow.index');

Route::resource('expenses', ExpenseController::class);

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
    '/reports/purchases',
    [PurchaseReportController::class, 'index']
)->name('reports.purchases.index');

Route::get(
    '/reports/profit-loss',
    [ProfitLossReportController::class, 'index']
)->name('reports.profit-loss.index');

Route::get(
    '/reports/payables',
    [PayableReportController::class, 'index']
)->name('reports.payables.index');

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

Route::get(
    '/reports/receivables',
    [ReceivableReportController::class, 'index']
)->name('reports.receivables.index');

Route::get(
    '/reports',
    [ReportController::class, 'index']
)->name('reports.index');

Route::resource('suppliers', SupplierController::class);

Route::get(
    '/reports/sales',
    [SalesReportController::class, 'index']
)->name('reports.sales.index');

Route::get(
    '/reports/stock',
    [StockReportController::class, 'index']
)->name('reports.stock.index');

Route::resource(
    'users',
    UserManagementController::class
);