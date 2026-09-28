<?php

namespace App\Http\Controllers;

use App\Models\Order;

class InvoiceProjectController extends Controller
{
    /**
     * Menampilkan daftar invoice project.
     */
    public function index()
    {
        $orders = Order::with([
            'customer',
            'product',
        ])
            ->latest('order_date')
            ->paginate(10);

        return view(
            'invoice_projects.index',
            compact('orders')
        );
    }

    /**
     * Menampilkan detail invoice.
     */
    public function show(Order $order)
    {
        $order->load([
            'customer',
            'product',
        ]);

        return view(
            'invoice_projects.show',
            compact('order')
        );
    }

    /**
     * Menampilkan halaman cetak invoice.
     */
    public function print(Order $order)
    {
        $order->load([
            'customer',
            'product',
        ]);

        return view(
            'invoice_projects.print',
            compact('order')
        );
    }
}