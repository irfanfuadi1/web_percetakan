<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Menampilkan daftar item.
     */
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    /**
     * Form tambah item.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Menyimpan item baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:50',
                'unique:products,code',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'supplier_category' => [
                'required',
                'string',
                'max:150',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ], [
            'code.required' => 'Kode item wajib diisi.',
            'code.unique' => 'Kode item sudah digunakan.',
            'name.required' => 'Nama item wajib diisi.',
            'supplier_category.required' => 'Supplier (Kategori) wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'unit.required' => 'Satuan wajib diisi.',
            'purchase_price.required' => 'Harga beli wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Item berhasil ditambahkan.');
    }

    /**
     * Detail item.
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }

    /**
     * Form edit item.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update item.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('products', 'code')
                    ->ignore($product->id),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'supplier_category' => [
                'required',
                'string',
                'max:150',
            ],

            'stock' => [
                'required',
                'integer',
                'min:0',
            ],

            'unit' => [
                'required',
                'string',
                'max:50',
            ],

            'purchase_price' => [
                'required',
                'numeric',
                'min:0',
            ],

            'selling_price' => [
                'required',
                'numeric',
                'min:0',
            ],
        ], [
            'code.required' => 'Kode item wajib diisi.',
            'code.unique' => 'Kode item sudah digunakan.',
            'name.required' => 'Nama item wajib diisi.',
            'supplier_category.required' => 'Supplier (Kategori) wajib diisi.',
            'stock.required' => 'Stok wajib diisi.',
            'unit.required' => 'Satuan wajib diisi.',
            'purchase_price.required' => 'Harga beli wajib diisi.',
            'selling_price.required' => 'Harga jual wajib diisi.',
        ]);

        $product->update($validated);

        return redirect()
            ->route('products.index')
            ->with('success', 'Item berhasil diperbarui.');
    }

    /**
     * Hapus item.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->with('success', 'Item berhasil dihapus.');
    }
}
