<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class PurchaseController extends Controller
{
    /**
     * Menampilkan daftar pembelian.
     */
    public function index()
    {
        $purchases = Purchase::with([
            'supplier',
            'product',
        ])
            ->latest('purchase_date')
            ->paginate(10);

        return view(
            'purchases.index',
            compact('purchases')
        );
    }

    /**
     * Form tambah pembelian.
     */
    public function create()
    {
        $suppliers = Supplier::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

        return view(
            'purchases.create',
            compact(
                'suppliers',
                'products'
            )
        );
    }

    /**
     * Menyimpan pembelian.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'purchase_code' => [
                'required',
                'string',
                'max:50',
                'unique:purchases,purchase_code',
            ],

            'purchase_date' => [
                'required',
                'date',
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
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
                    'LUNAS',
                    'BELUM LUNAS',
                ]),
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ], [
            'purchase_code.required' =>
                'Kode pembelian wajib diisi.',

            'purchase_code.unique' =>
                'Kode pembelian sudah digunakan.',

            'purchase_date.required' =>
                'Tanggal pembelian wajib diisi.',

            'supplier_id.required' =>
                'Supplier wajib dipilih.',

            'supplier_id.exists' =>
                'Supplier tidak ditemukan.',

            'product_id.required' =>
                'Produk wajib dipilih.',

            'product_id.exists' =>
                'Produk tidak ditemukan.',

            'quantity.required' =>
                'Jumlah wajib diisi.',

            'unit.required' =>
                'Satuan wajib diisi.',

            'price.required' =>
                'Harga beli wajib diisi.',

            'paid.required' =>
                'Jumlah dibayar wajib diisi.',
        ]);

        $total =
            $validated['quantity'] *
            $validated['price'];

        if ($validated['paid'] > $total) {
            return back()
                ->withInput()
                ->withErrors([
                    'paid' =>
                        'Jumlah dibayar tidak boleh melebihi total pembelian.',
                ]);
        }

        $validated['total'] = $total;

        $validated['status'] =
            $validated['paid'] >= $total
                ? 'LUNAS'
                : 'BELUM LUNAS';

        DB::transaction(function () use ($validated) {

            Purchase::create($validated);

            Product::where(
                'id',
                $validated['product_id']
            )->increment(
                'stock',
                $validated['quantity']
            );
        });

        return redirect()
            ->route('purchases.index')
            ->with(
                'success',
                'Pembelian berhasil ditambahkan dan stok produk diperbarui.'
            );
    }

    /**
     * Menampilkan detail pembelian.
     */
    public function show(Purchase $purchase)
    {
        $purchase->load([
            'supplier',
            'product',
        ]);

        return view(
            'purchases.show',
            compact('purchase')
        );
    }

    /**
     * Form edit pembelian.
     */
    public function edit(Purchase $purchase)
    {
        $suppliers = Supplier::orderBy('name')->get();

        $products = Product::orderBy('name')->get();

        return view(
            'purchases.edit',
            compact(
                'purchase',
                'suppliers',
                'products'
            )
        );
    }

    /**
     * Memperbarui pembelian.
     */
    public function update(
        Request $request,
        Purchase $purchase
    ) {
        $validated = $request->validate([
            'purchase_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique(
                    'purchases',
                    'purchase_code'
                )->ignore($purchase->id),
            ],

            'purchase_date' => [
                'required',
                'date',
            ],

            'supplier_id' => [
                'required',
                'exists:suppliers,id',
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
                    'LUNAS',
                    'BELUM LUNAS',
                ]),
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ]);

        $total =
            $validated['quantity'] *
            $validated['price'];

        if ($validated['paid'] > $total) {
            return back()
                ->withInput()
                ->withErrors([
                    'paid' =>
                        'Jumlah dibayar tidak boleh melebihi total pembelian.',
                ]);
        }

        $validated['total'] = $total;

        $validated['status'] =
            $validated['paid'] >= $total
                ? 'LUNAS'
                : 'BELUM LUNAS';

        DB::transaction(function () use (
            $validated,
            $purchase
        ) {

            /*
             * Kembalikan stok dari pembelian lama.
             */
            Product::where(
                'id',
                $purchase->product_id
            )->decrement(
                'stock',
                $purchase->quantity
            );

            /*
             * Update transaksi pembelian.
             */
            $purchase->update($validated);

            /*
             * Tambahkan stok berdasarkan
             * pembelian terbaru.
             */
            Product::where(
                'id',
                $validated['product_id']
            )->increment(
                'stock',
                $validated['quantity']
            );
        });

        return redirect()
            ->route('purchases.index')
            ->with(
                'success',
                'Pembelian berhasil diperbarui dan stok disesuaikan.'
            );
    }

    /**
     * Menghapus pembelian.
     */
    public function destroy(Purchase $purchase)
    {
        DB::transaction(function () use ($purchase) {

            /*
             * Kurangi kembali stok yang berasal
             * dari transaksi pembelian ini.
             */
            Product::where(
                'id',
                $purchase->product_id
            )->decrement(
                'stock',
                $purchase->quantity
            );

            $purchase->delete();
        });

        return redirect()
            ->route('purchases.index')
            ->with(
                'success',
                'Pembelian berhasil dihapus dan stok dikembalikan.'
            );
    }
}