<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class StockReportController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | BATAS STOK MENIPIS
        |--------------------------------------------------------------------------
        */

        $lowStockLimit = 10;


        /*
        |--------------------------------------------------------------------------
        | DATA PRODUK
        |--------------------------------------------------------------------------
        */

        $products = Product::orderBy('name')->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL NILAI ASET
        |--------------------------------------------------------------------------
        |
        | Nilai aset = stok × harga beli
        |
        */

        $totalAssetValue = $products->sum(function ($product) {

            return
                (float) $product->stock
                *
                (float) $product->purchase_price;
        });


        /*
        |--------------------------------------------------------------------------
        | TOTAL SKU
        |--------------------------------------------------------------------------
        */

        $totalItems = $products->count();


        /*
        |--------------------------------------------------------------------------
        | STOK MENIPIS
        |--------------------------------------------------------------------------
        */

        $lowStockItems = $products->where(
            'stock',
            '<=',
            $lowStockLimit
        )->count();


        /*
        |--------------------------------------------------------------------------
        | TAB
        |--------------------------------------------------------------------------
        */

        $activeTab = $request->input(
            'tab',
            'current'
        );


        /*
        |--------------------------------------------------------------------------
        | RIWAYAT MUTASI / KARTU STOK
        |--------------------------------------------------------------------------
        */

        $stockMovements = collect();


        if ($activeTab === 'history') {

            /*
            |--------------------------------------------------------------------------
            | PEMBELIAN = STOK MASUK
            |--------------------------------------------------------------------------
            */

            $purchases = Purchase::with('product')
                ->whereHas('product')
                ->latest('purchase_date')
                ->get();

            foreach ($purchases as $purchase) {

                $stockMovements->push([

                    'date' => $purchase->purchase_date,

                    'code' => $purchase->product->code,

                    'product' => $purchase->product->name,

                    'type' => 'Masuk',

                    'reference' => $purchase->purchase_code,

                    'quantity' => (float) $purchase->quantity,

                    'unit' => $purchase->unit,

                    'description' => 'Pembelian barang',

                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | PESANAN = STOK KELUAR
            |--------------------------------------------------------------------------
            */

            $orders = Order::with('product')
                ->whereHas('product')
                ->where('status', '!=', 'Dibatalkan')
                ->latest('order_date')
                ->get();

            foreach ($orders as $order) {

                $stockMovements->push([

                    'date' => $order->order_date,

                    'code' => $order->product->code,

                    'product' => $order->product->name,

                    'type' => 'Keluar',

                    'reference' => $order->invoice_code,

                    'quantity' => (float) $order->quantity,

                    'unit' => $order->unit,

                    'description' => 'Penjualan barang',

                ]);
            }


            /*
            |--------------------------------------------------------------------------
            | URUTKAN BERDASARKAN TANGGAL
            |--------------------------------------------------------------------------
            */

            $stockMovements = $stockMovements
                ->sortByDesc('date')
                ->values();


            /*
            |--------------------------------------------------------------------------
            | PAGINATION
            |--------------------------------------------------------------------------
            */

            $perPage = 10;

            $currentPage = LengthAwarePaginator::resolveCurrentPage();

            $currentItems = $stockMovements
                ->slice(
                    ($currentPage - 1) * $perPage,
                    $perPage
                )
                ->values();

            $stockMovements = new LengthAwarePaginator(
                $currentItems,
                $stockMovements->count(),
                $perPage,
                $currentPage,
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );
        }


        return view(
            'reports.stock.index',
            compact(
                'products',
                'totalAssetValue',
                'totalItems',
                'lowStockItems',
                'lowStockLimit',
                'activeTab',
                'stockMovements'
            )
        );
    }
}
