<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | WAKTU
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();

        $monthStart = Carbon::now()->startOfMonth();

        $monthEnd = Carbon::now()->endOfMonth();


        /*
        |--------------------------------------------------------------------------
        | STATISTIK UTAMA
        |--------------------------------------------------------------------------
        */

        // Pelanggan yang dibuat hari ini
        $newCustomersToday = Customer::whereDate(
            'created_at',
            $today
        )->count();


        // Pesanan yang dibuat hari ini
        $newOrdersToday = Order::whereDate(
            'order_date',
            $today
        )->count();


        // Total penjualan bulan berjalan
        // Pesanan yang dibatalkan tidak dihitung.
        $monthlySales = Order::whereBetween(
            'order_date',
            [$monthStart, $monthEnd]
        )
            ->where('status', '!=', 'Dibatalkan')
            ->sum('total');


        // Total pelanggan
        $totalCustomers = Customer::count();


        /*
        |--------------------------------------------------------------------------
        | STATUS PESANAN
        |--------------------------------------------------------------------------
        */

        $processingOrders = Order::where(
            'status',
            'Diproses'
        )->count();


        $completedOrders = Order::where(
            'status',
            'Selesai'
        )->count();


        // Pesanan yang belum membayar sama sekali
        $unpaidOrders = Order::whereColumn(
            'paid',
            '<=',
            DB::raw('0')
        )
            ->whereColumn(
                'total',
                '>',
                DB::raw('0')
            )
            ->where('status', '!=', 'Dibatalkan')
            ->count();


        // Pesanan yang sudah lunas
        $paidOrders = Order::whereColumn(
            'paid',
            '>=',
            DB::raw('total')
        )
            ->whereColumn(
                'total',
                '>',
                DB::raw('0')
            )
            ->where('status', '!=', 'Dibatalkan')
            ->count();


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI TERAKHIR
        |--------------------------------------------------------------------------
        */

        $latestOrders = Order::with([
            'customer',
            'product',
        ])
            ->latest('order_date')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | STOK MENIPIS
        |--------------------------------------------------------------------------
        |
        | Produk dengan stok <= 5 dianggap mulai menipis.
        |
        */

        $lowStockLimit = 5;

        $lowStockProducts = Product::where(
            'stock',
            '<=',
            $lowStockLimit
        )
            ->orderBy('stock', 'asc')
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | PRODUK TERLARIS BULAN INI
        |--------------------------------------------------------------------------
        |
        | Mengambil jumlah quantity dari transaksi bulan berjalan.
        | Pesanan Dibatalkan tidak dihitung.
        |
        */

        $topProducts = Product::query()
            ->select(
                'products.id',
                'products.name'
            )
            ->join(
                'orders',
                'orders.product_id',
                '=',
                'products.id'
            )
            ->whereBetween(
                'orders.order_date',
                [$monthStart, $monthEnd]
            )
            ->where(
                'orders.status',
                '!=',
                'Dibatalkan'
            )
            ->groupBy(
                'products.id',
                'products.name'
            )
            ->selectRaw(
                'SUM(orders.quantity) as sold_quantity'
            )
            ->orderByDesc(
                'sold_quantity'
            )
            ->limit(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | KIRIM KE VIEW
        |--------------------------------------------------------------------------
        */

        return view('dashboard.index', compact(
            'newCustomersToday',
            'newOrdersToday',
            'monthlySales',
            'totalCustomers',
            'processingOrders',
            'completedOrders',
            'unpaidOrders',
            'paidOrders',
            'latestOrders',
            'lowStockProducts',
            'topProducts',
            'lowStockLimit'
        ));
    }
}