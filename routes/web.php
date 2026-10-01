<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AuthController;
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


/*
|--------------------------------------------------------------------------
| HALAMAN UTAMA
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| AUTHENTICATION
|--------------------------------------------------------------------------
|
| Route login dapat diakses tanpa authentication.
|
*/

Route::middleware('guest')->group(function () {

    Route::get(
        '/login',
        [AuthController::class, 'showLogin']
    )->name('login');

    Route::post(
        '/login',
        [AuthController::class, 'login']
    )->name('login.process');

});


/*
|--------------------------------------------------------------------------
| LOGOUT
|--------------------------------------------------------------------------
|
| Logout hanya dapat dilakukan oleh user yang sudah login.
|
*/

Route::post(
    '/logout',
    [AuthController::class, 'logout']
)->middleware('auth')->name('logout');


/*
|--------------------------------------------------------------------------
| SISTEM
|--------------------------------------------------------------------------
|
| Semua halaman utama aplikasi berada di dalam middleware auth.
| User harus login terlebih dahulu untuk mengaksesnya.
|
*/

Route::middleware('auth')->group(function () {


    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | SYSTEM
    |--------------------------------------------------------------------------
    */

    // Riwayat Aktivitas
    Route::get(
        '/activity-logs',
        [ActivityLogController::class, 'index']
    )->name('activity-logs.index');


    // Manajemen User
    Route::resource(
        'users',
        UserManagementController::class
    );


    /*
    |--------------------------------------------------------------------------
    | MASTER DATA
    |--------------------------------------------------------------------------
    */

    // Kategori
    Route::resource(
        'categories',
        CategoryController::class
    );


    // Pelanggan
    Route::resource(
        'customers',
        CustomerController::class
    );


    // Kas / Akun
    Route::resource(
        'cash-accounts',
        CashAccountController::class
    );


    // Master Item / Produk
    Route::resource(
        'products',
        ProductController::class
    );


    // Supplier
    Route::resource(
        'suppliers',
        SupplierController::class
    );


    /*
    |--------------------------------------------------------------------------
    | PRODUKSI
    |--------------------------------------------------------------------------
    */

    // Antrian Produksi
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


    /*
    |--------------------------------------------------------------------------
    | TRANSAKSI
    |--------------------------------------------------------------------------
    */

    // Pengeluaran
    Route::resource(
        'expenses',
        ExpenseController::class
    );


    // Pesanan
    Route::resource(
        'orders',
        OrderController::class
    );


    // Pembelian
    Route::resource(
        'purchases',
        PurchaseController::class
    );


    /*
    |--------------------------------------------------------------------------
    | INVOICE PROJECT
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | PIUTANG
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | LAPORAN
    |--------------------------------------------------------------------------
    */

    // Pusat Laporan
    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');


    // Laporan Penjualan
    Route::get(
        '/reports/sales',
        [SalesReportController::class, 'index']
    )->name('reports.sales.index');


    // Laporan Pembelian
    Route::get(
        '/reports/purchases',
        [PurchaseReportController::class, 'index']
    )->name('reports.purchases.index');


    // Laporan Arus Kas
    Route::get(
        '/reports/cash-flow',
        [CashFlowReportController::class, 'index']
    )->name('reports.cash-flow.index');


    // Laporan Laba Rugi
    Route::get(
        '/reports/profit-loss',
        [ProfitLossReportController::class, 'index']
    )->name('reports.profit-loss.index');


    // Laporan Stok
    Route::get(
        '/reports/stock',
        [StockReportController::class, 'index']
    )->name('reports.stock.index');


    // Laporan Piutang
    Route::get(
        '/reports/receivables',
        [ReceivableReportController::class, 'index']
    )->name('reports.receivables.index');


    // Laporan Hutang
    Route::get(
        '/reports/payables',
        [PayableReportController::class, 'index']
    )->name('reports.payables.index');

});