<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Menampilkan daftar pelanggan.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(10);

        return view('customers.index', compact('customers'));
    }

    /**
     * Menampilkan form tambah pelanggan.
     */
    public function create()
    {
        return view('customers.create');
    }

    /**
     * Menyimpan pelanggan baru.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:50',
                'unique:customers,code',
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'customer_type' => [
                'required',
                Rule::in(['Member', 'Umum']),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
            ],
        ], [
            'code.required' => 'Kode pelanggan wajib diisi.',
            'code.unique' => 'Kode pelanggan sudah digunakan.',

            'name.required' => 'Nama pelanggan wajib diisi.',

            'customer_type.required' => 'Jenis pelanggan wajib dipilih.',
            'customer_type.in' => 'Jenis pelanggan harus Member atau Umum.',
        ]);

        Customer::create($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail pelanggan.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Menampilkan form edit pelanggan.
     */
    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    /**
     * Memperbarui data pelanggan.
     */
    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('customers', 'code')
                    ->ignore($customer->id),
            ],

            'name' => [
                'required',
                'string',
                'max:150',
            ],

            'customer_type' => [
                'required',
                Rule::in(['Member', 'Umum']),
            ],

            'phone' => [
                'nullable',
                'string',
                'max:30',
            ],

            'address' => [
                'nullable',
                'string',
            ],
        ], [
            'code.required' => 'Kode pelanggan wajib diisi.',
            'code.unique' => 'Kode pelanggan sudah digunakan.',

            'name.required' => 'Nama pelanggan wajib diisi.',

            'customer_type.required' => 'Jenis pelanggan wajib dipilih.',
            'customer_type.in' => 'Jenis pelanggan harus Member atau Umum.',
        ]);

        $customer->update($validated);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil diperbarui.');
    }

    /**
     * Menghapus pelanggan.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()
            ->route('customers.index')
            ->with('success', 'Pelanggan berhasil dihapus.');
    }
}
