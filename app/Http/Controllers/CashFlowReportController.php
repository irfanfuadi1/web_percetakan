<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Order;
use App\Models\Purchase;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CashFlowReportController extends Controller
{
    public function index(Request $request)
    {
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
        | VALIDASI PERIODE
        |--------------------------------------------------------------------------
        */

        if ($fromDate > $toDate) {
            return redirect()
                ->route('reports.cash-flow.index')
                ->with('error', 'Tanggal mulai tidak boleh lebih besar dari tanggal akhir.');
        }


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI MASUK DARI PESANAN
        |--------------------------------------------------------------------------
        */

        $orderFlows = Order::with('customer')
            ->whereDate('order_date', '>=', $fromDate)
            ->whereDate('order_date', '<=', $toDate)
            ->where('paid', '>', 0)
            ->where('status', '!=', 'Dibatalkan')
            ->get()
            ->map(function ($order) {

                return [
                    'date' => $order->order_date,
                    'cash_account' => 'Kas Penjualan',
                    'type' => 'Masuk',
                    'description' => 'Pembayaran Pesanan #' . $order->invoice_code,
                    'amount' => (float) $order->paid,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI KELUAR DARI PEMBELIAN
        |--------------------------------------------------------------------------
        */

        $purchaseFlows = Purchase::with('supplier')
            ->whereDate('purchase_date', '>=', $fromDate)
            ->whereDate('purchase_date', '<=', $toDate)
            ->where('paid', '>', 0)
            ->get()
            ->map(function ($purchase) {

                return [
                    'date' => $purchase->purchase_date,
                    'cash_account' => 'Kas Pembelian',
                    'type' => 'Keluar',
                    'description' => 'Pembayaran Pembelian #' . $purchase->purchase_code,
                    'amount' => (float) $purchase->paid,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | TRANSAKSI KELUAR DARI PENGELUARAN
        |--------------------------------------------------------------------------
        */

        $expenseFlows = Expense::with('cashAccount')
            ->whereDate('expense_date', '>=', $fromDate)
            ->whereDate('expense_date', '<=', $toDate)
            ->get()
            ->map(function ($expense) {

                return [
                    'date' => $expense->expense_date,
                    'cash_account' => $expense->cashAccount
                        ? $expense->cashAccount->name
                        : 'Tidak diketahui',
                    'type' => 'Keluar',
                    'description' => $expense->description,
                    'amount' => (float) $expense->amount,
                ];
            });


        /*
        |--------------------------------------------------------------------------
        | GABUNGKAN SEMUA ARUS KAS
        |--------------------------------------------------------------------------
        */

        $cashFlows = $orderFlows
            ->concat($purchaseFlows)
            ->concat($expenseFlows)
            ->sortByDesc('date')
            ->values();


        /*
        |--------------------------------------------------------------------------
        | TOTAL MASUK
        |--------------------------------------------------------------------------
        */

        $totalIn = $cashFlows
            ->where('type', 'Masuk')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | TOTAL KELUAR
        |--------------------------------------------------------------------------
        */

        $totalOut = $cashFlows
            ->where('type', 'Keluar')
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | NET FLOW
        |--------------------------------------------------------------------------
        */

        $netFlow = $totalIn - $totalOut;


        /*
        |--------------------------------------------------------------------------
        | PAGINATION
        |--------------------------------------------------------------------------
        */

        $perPage = 10;

        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $currentItems = $cashFlows
            ->slice(
                ($currentPage - 1) * $perPage,
                $perPage
            )
            ->values();

        $cashFlows = new LengthAwarePaginator(
            $currentItems,
            $cashFlows->count(),
            $perPage,
            $currentPage,
            [
                'path' => request()->url(),
                'query' => request()->query(),
            ]
        );


        return view(
            'reports.cash-flow.index',
            compact(
                'cashFlows',
                'fromDate',
                'toDate',
                'totalIn',
                'totalOut',
                'netFlow'
            )
        );
    }
}
