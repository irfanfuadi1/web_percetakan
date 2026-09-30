<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use Illuminate\Http\Request;

class ProfitLossReportController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER PERIODE
        |--------------------------------------------------------------------------
        */

        $fromDate = $request->input(
            'from_date',
            now()->startOfMonth()->format('Y-m-d')
        );

        $toDate = $request->input(
            'to_date',
            now()->format('Y-m-d')
        );


        /*
        |--------------------------------------------------------------------------
        | VALIDASI TANGGAL
        |--------------------------------------------------------------------------
        */

        if ($fromDate > $toDate) {
            return redirect()
                ->route('reports.profit-loss.index')
                ->with(
                    'error',
                    'Tanggal mulai tidak boleh lebih besar dari tanggal akhir.'
                );
        }


        /*
        |--------------------------------------------------------------------------
        | DATA PENJUALAN
        |--------------------------------------------------------------------------
        |
        | Penjualan dihitung dari total transaksi order.
        | Pesanan dengan status Dibatalkan tidak dihitung.
        |
        */

        $orders = Order::with('product')
            ->whereDate('order_date', '>=', $fromDate)
            ->whereDate('order_date', '<=', $toDate)
            ->where('status', '!=', 'Dibatalkan')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PENJUALAN KOTOR
        |--------------------------------------------------------------------------
        */

        $totalRevenue = $orders->sum(function ($order) {

            return (float) $order->total;
        });


        /*
        |--------------------------------------------------------------------------
        | TOTAL HPP
        |--------------------------------------------------------------------------
        |
        | HPP = jumlah barang terjual × harga beli produk
        |
        */

        $totalHpp = $orders->sum(function ($order) {

            if (!$order->product) {
                return 0;
            }

            return
                (float) $order->quantity
                *
                (float) $order->product->purchase_price;
        });


        /*
        |--------------------------------------------------------------------------
        | LABA KOTOR
        |--------------------------------------------------------------------------
        */

        $grossProfit = $totalRevenue - $totalHpp;


        /*
        |--------------------------------------------------------------------------
        | BIAYA OPERASIONAL
        |--------------------------------------------------------------------------
        */

        $totalOperatingExpense = Expense::whereDate(
            'expense_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'expense_date',
                '<=',
                $toDate
            )
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | LABA BERSIH
        |--------------------------------------------------------------------------
        */

        $netProfit = $grossProfit - $totalOperatingExpense;


        /*
        |--------------------------------------------------------------------------
        | JUMLAH TRANSAKSI
        |--------------------------------------------------------------------------
        */

        $totalTransactions = $orders->count();


        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view(
            'reports.profit-loss.index',
            compact(
                'fromDate',
                'toDate',
                'totalRevenue',
                'totalHpp',
                'grossProfit',
                'totalOperatingExpense',
                'netProfit',
                'totalTransactions'
            )
        );
    }
}
