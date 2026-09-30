<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseReportController extends Controller
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

        $purchases = Purchase::with([
            'supplier',
            'product',
        ])
            ->whereDate('purchase_date', '>=', $fromDate)
            ->whereDate('purchase_date', '<=', $toDate)
            ->latest('purchase_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $totalPurchases = Purchase::whereDate(
            'purchase_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'purchase_date',
                '<=',
                $toDate
            )
            ->sum('total');

        $totalPaid = Purchase::whereDate(
            'purchase_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'purchase_date',
                '<=',
                $toDate
            )
            ->sum('paid');

        $totalPayable = $totalPurchases - $totalPaid;

        $totalTransactions = Purchase::whereDate(
            'purchase_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'purchase_date',
                '<=',
                $toDate
            )
            ->count();

        return view('reports.purchases.index', compact(
            'purchases',
            'fromDate',
            'toDate',
            'totalPurchases',
            'totalPaid',
            'totalPayable',
            'totalTransactions'
        ));
    }
}
