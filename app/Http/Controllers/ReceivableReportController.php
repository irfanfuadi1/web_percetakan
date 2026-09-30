<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReceivableReportController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DATA PIUTANG
        |--------------------------------------------------------------------------
        |
        | Piutang berasal dari pesanan yang:
        |
        | 1. Tidak dibatalkan
        | 2. Jumlah dibayar masih lebih kecil dari total
        |
        */

        $orders = Order::with([
            'customer',
            'product',
        ])
            ->where('status', '!=', 'Dibatalkan')
            ->whereColumn('paid', '<', 'total')
            ->latest('order_date')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | TOTAL PIUTANG
        |--------------------------------------------------------------------------
        |
        | Karena menggunakan pagination, total piutang dihitung
        | menggunakan query terpisah.
        |
        */

        $totalReceivable = Order::query()
            ->where('status', '!=', 'Dibatalkan')
            ->whereColumn('paid', '<', 'total')
            ->get()
            ->sum(function ($order) {
                return (float) $order->total
                    - (float) $order->paid;
            });


        /*
        |--------------------------------------------------------------------------
        | JUMLAH INVOICE GANTUNG
        |--------------------------------------------------------------------------
        */

        $totalOutstandingInvoices = Order::query()
            ->where('status', '!=', 'Dibatalkan')
            ->whereColumn('paid', '<', 'total')
            ->count();


        return view(
            'reports.receivables.index',
            compact(
                'orders',
                'totalReceivable',
                'totalOutstandingInvoices'
            )
        );
    }
}
