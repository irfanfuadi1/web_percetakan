<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class SalesReportController extends Controller
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

        $orders = Order::with([
            'customer',
            'product',
        ])
            ->whereDate('order_date', '>=', $fromDate)
            ->whereDate('order_date', '<=', $toDate)
            ->latest('order_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $totalSales = Order::whereDate(
            'order_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'order_date',
                '<=',
                $toDate
            )
            ->sum('total');

        $totalPaid = Order::whereDate(
            'order_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'order_date',
                '<=',
                $toDate
            )
            ->sum('paid');

        $totalReceivable = $totalSales - $totalPaid;

        $totalTransactions = Order::whereDate(
            'order_date',
            '>=',
            $fromDate
        )
            ->whereDate(
                'order_date',
                '<=',
                $toDate
            )
            ->count();

        return view('reports.sales.index', compact(
            'orders',
            'fromDate',
            'toDate',
            'totalSales',
            'totalPaid',
            'totalReceivable',
            'totalTransactions'
        ));
    }
}
