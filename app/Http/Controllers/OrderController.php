<?php

namespace App\Http\Controllers;

use App\Helpers\ActivityLogger;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\ProductionQueue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    /**
     * Menampilkan daftar pesanan.
     */
    public function index()
    {
        $orders = Order::with([
            'customer',
            'product',
        ])
            ->latest('order_date')
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }


    /**
     * Form tambah pesanan.
     */
    public function create()
    {
        $customers = Customer::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

        return view('orders.create', compact(
            'customers',
            'products'
        ));
    }


    /**
     * Simpan pesanan.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'invoice_code' => [
                'required',
                'string',
                'max:50',
                'unique:orders,invoice_code',
            ],

            'order_date' => [
                'required',
                'date',
            ],

            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'paid' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Menunggu',
                    'Diproses',
                    'Selesai',
                    'Dibatalkan',
                ]),
            ],

            'specification' => [
                'nullable',
                'string',
                'max:255',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:10240',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ], [
            'invoice_code.required' => 'Kode invoice/nota wajib diisi.',
            'invoice_code.unique' => 'Kode invoice/nota sudah digunakan.',
            'order_date.required' => 'Tanggal pesanan wajib diisi.',
            'customer_id.required' => 'Pelanggan wajib dipilih.',
            'customer_id.exists' => 'Pelanggan tidak ditemukan.',
            'product_id.required' => 'Produk wajib dipilih.',
            'product_id.exists' => 'Produk tidak ditemukan.',
            'quantity.required' => 'Jumlah wajib diisi.',
            'unit.required' => 'Satuan wajib diisi.',
            'price.required' => 'Harga wajib diisi.',
            'paid.required' => 'Jumlah dibayar wajib diisi.',
        ]);

        if ($validated['paid'] > ($validated['quantity'] * $validated['price'])) {
            return back()
                ->withInput()
                ->withErrors([
                    'paid' => 'Jumlah dibayar tidak boleh melebihi total pesanan.',
                ]);
        }

        $validated['total'] =
            $validated['quantity'] * $validated['price'];

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request
                ->file('file')
                ->store('order-files', 'public');
        }

        unset($validated['file']);

        $order = Order::create($validated);

        ActivityLogger::log(
            'Create Order',
            'Membuat Pesanan Baru #' .
                $order->invoice_code .
                ' (Total: Rp ' .
                number_format($order->total, 0, ',', '.') .
                ')'
        );

        if (
            in_array($order->status, ['Menunggu', 'Diproses'])
        ) {
            ProductionQueue::create([
                'invoice_code' => $order->invoice_code,
                'invoice_date' => $order->order_date,
                'payment_status' =>
                $order->paid >= $order->total
                    ? 'LUNAS'
                    : 'BELUM LUNAS',
                'customer_name' => $order->customer->name,
                'item' =>
                $order->product->name .
                    ' - ' .
                    $order->quantity .
                    ' ' .
                    $order->unit,
                'specification' =>
                $order->specification ?? '-',
                'file_path' => $order->file_path,
                'progress' => 0,
                'production_status' => $order->status,
            ]);
        }

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil ditambahkan.');
    }


    /**
     * Detail pesanan.
     */
    public function show(Order $order)
    {
        $order->load([
            'customer',
            'product',
        ]);

        return view('orders.show', compact('order'));
    }


    /**
     * Form edit.
     */
    public function edit(Order $order)
    {
        $customers = Customer::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

        return view('orders.edit', compact(
            'order',
            'customers',
            'products'
        ));
    }


    /**
     * Update pesanan.
     */
    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'invoice_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('orders', 'invoice_code')
                    ->ignore($order->id),
            ],

            'order_date' => [
                'required',
                'date',
            ],

            'customer_id' => [
                'required',
                'exists:customers,id',
            ],

            'product_id' => [
                'required',
                'exists:products,id',
            ],

            'quantity' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
            ],

            'price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'paid' => [
                'required',
                'numeric',
                'min:0',
            ],

            'status' => [
                'required',
                Rule::in([
                    'Menunggu',
                    'Diproses',
                    'Selesai',
                    'Dibatalkan',
                ]),
            ],

            'specification' => [
                'nullable',
                'string',
                'max:255',
            ],

            'file' => [
                'nullable',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:10240',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $total =
            $validated['quantity'] * $validated['price'];

        if ($validated['paid'] > $total) {
            return back()
                ->withInput()
                ->withErrors([
                    'paid' => 'Jumlah dibayar tidak boleh melebihi total pesanan.',
                ]);
        }

        $validated['total'] = $total;

        if ($request->hasFile('file')) {

            if (
                $order->file_path &&
                Storage::disk('public')->exists(
                    $order->file_path
                )
            ) {
                Storage::disk('public')->delete(
                    $order->file_path
                );
            }

            $validated['file_path'] = $request
                ->file('file')
                ->store('order-files', 'public');
        }

        unset($validated['file']);

        $order->update($validated);

        $order->refresh();

        if (
            in_array($order->status, ['Menunggu', 'Diproses'])
        ) {
            ProductionQueue::updateOrCreate(
                [
                    'invoice_code' => $order->invoice_code,
                ],
                [
                    'invoice_date' => $order->order_date,
                    'payment_status' =>
                    $order->paid >= $order->total
                        ? 'LUNAS'
                        : 'BELUM LUNAS',
                    'customer_name' => $order->customer->name,
                    'item' =>
                    $order->product->name .
                        ' - ' .
                        $order->quantity .
                        ' ' .
                        $order->unit,
                    'specification' =>
                    $order->specification ?? '-',
                    'file_path' => $order->file_path,
                    'production_status' => $order->status,
                ]
            );
        } else {
            ProductionQueue::where(
                'invoice_code',
                $order->invoice_code
            )->delete();
        }

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil diperbarui.');
    }


    /**
     * Hapus pesanan.
     */
    public function destroy(Order $order)
    {
        if (
            $order->file_path &&
            Storage::disk('public')->exists(
                $order->file_path
            )
        ) {
            Storage::disk('public')->delete(
                $order->file_path
            );
        }

        $order->delete();

        return redirect()
            ->route('orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }
}
