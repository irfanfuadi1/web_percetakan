<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class ReceivableController extends Controller
{
    /**
     * Menampilkan daftar piutang.
     */
    public function index()
    {
        $receivables = Order::with([
            'customer',
            'product',
        ])
            ->whereColumn('paid', '<', 'total')
            ->where('status', '!=', 'Dibatalkan')
            ->latest('order_date')
            ->paginate(10);

        $totalReceivable = Order::whereColumn(
            'paid',
            '<',
            'total'
        )
            ->where('status', '!=', 'Dibatalkan')
            ->selectRaw('SUM(total - paid) as total')
            ->value('total') ?? 0;

        $totalInvoices = Order::whereColumn(
            'paid',
            '<',
            'total'
        )
            ->where('status', '!=', 'Dibatalkan')
            ->count();

        $totalCustomers = Order::whereColumn(
            'paid',
            '<',
            'total'
        )
            ->where('status', '!=', 'Dibatalkan')
            ->distinct('customer_id')
            ->count('customer_id');

        return view(
            'receivables.index',
            compact(
                'receivables',
                'totalReceivable',
                'totalInvoices',
                'totalCustomers'
            )
        );
    }

    /**
     * Menampilkan detail piutang.
     */
    public function show(Order $order)
    {
        $order->load([
            'customer',
            'product',
        ]);

        return view(
            'receivables.show',
            compact('order')
        );
    }

    /**
     * Memproses pembayaran piutang.
     */
    public function pay(Request $request, Order $order)
    {
        $request->validate([
            'payment' => [
                'required',
                'numeric',
                'min:0.01',
            ],
        ], [
            'payment.required' =>
                'Jumlah pembayaran wajib diisi.',
            'payment.numeric' =>
                'Jumlah pembayaran harus berupa angka.',
            'payment.min' =>
                'Jumlah pembayaran minimal Rp1.',
        ]);

        $remaining =
            $order->total - $order->paid;

        if ($request->payment > $remaining) {
            return back()
                ->withInput()
                ->withErrors([
                    'payment' =>
                        'Pembayaran tidak boleh melebihi sisa piutang.',
                ]);
        }

        $newPaid =
            $order->paid + $request->payment;

        $order->update([
            'paid' => $newPaid,
        ]);

        return redirect()
            ->route(
                'receivables.index'
            )
            ->with(
                'success',
                'Pembayaran piutang berhasil dicatat.'
            );
    }
}