<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PayableReportController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | DATA HUTANG
        |--------------------------------------------------------------------------
        |
        | Hutang berasal dari transaksi pembelian yang:
        |
        | 1. Tidak berstatus LUNAS
        | 2. Jumlah dibayar masih lebih kecil dari total pembelian
        |
        */

        $purchases = Purchase::with([
            'supplier',
            'product',
        ])
            ->whereColumn('paid', '<', 'total')
            ->latest('purchase_date')
            ->paginate(10)
            ->withQueryString();


        /*
        |--------------------------------------------------------------------------
        | TOTAL HUTANG
        |--------------------------------------------------------------------------
        */

        $totalPayable = Purchase::query()
            ->whereColumn('paid', '<', 'total')
            ->get()
            ->sum(function ($purchase) {

                return (float) $purchase->total
                    - (float) $purchase->paid;
            });


        /*
        |--------------------------------------------------------------------------
        | JUMLAH PEMBELIAN YANG MASIH MEMILIKI HUTANG
        |--------------------------------------------------------------------------
        */

        $totalOutstandingPurchases = Purchase::query()
            ->whereColumn('paid', '<', 'total')
            ->count();


        return view(
            'reports.payables.index',
            compact(
                'purchases',
                'totalPayable',
                'totalOutstandingPurchases'
            )
        );
    }
}
