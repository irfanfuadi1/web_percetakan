<?php

namespace App\Http\Controllers;

use App\Models\CashAccount;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CashAccountController extends Controller
{
    public function index()
    {
        $cashAccounts = CashAccount::latest()->paginate(10);

        return view('cash_accounts.index', compact('cashAccounts'));
    }

    public function create()
    {
        return view('cash_accounts.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'type' => [
                'required',
                Rule::in(['Kas', 'Bank', 'E-Wallet']),
            ],
            'balance' => [
                'required',
                'numeric',
                'min:0',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ], [
            'name.required' => 'Nama kas / akun wajib diisi.',
            'type.required' => 'Jenis wajib dipilih.',
            'balance.required' => 'Saldo wajib diisi.',
            'balance.numeric' => 'Saldo harus berupa angka.',
        ]);

        CashAccount::create($validated);

        return redirect()
            ->route('cash-accounts.index')
            ->with('success', 'Kas / akun berhasil ditambahkan.');
    }

    public function show(CashAccount $cashAccount)
    {
        return view('cash_accounts.show', compact('cashAccount'));
    }

    public function edit(CashAccount $cashAccount)
    {
        return view('cash_accounts.edit', compact('cashAccount'));
    }

    public function update(Request $request, CashAccount $cashAccount)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:150',
            ],
            'type' => [
                'required',
                Rule::in(['Kas', 'Bank', 'E-Wallet']),
            ],
            'balance' => [
                'required',
                'numeric',
                'min:0',
            ],
            'description' => [
                'nullable',
                'string',
            ],
        ], [
            'name.required' => 'Nama kas / akun wajib diisi.',
            'type.required' => 'Jenis wajib dipilih.',
            'balance.required' => 'Saldo wajib diisi.',
            'balance.numeric' => 'Saldo harus berupa angka.',
        ]);

        $cashAccount->update($validated);

        return redirect()
            ->route('cash-accounts.index')
            ->with('success', 'Kas / akun berhasil diperbarui.');
    }

    public function destroy(CashAccount $cashAccount)
    {
        $cashAccount->delete();

        return redirect()
            ->route('cash-accounts.index')
            ->with('success', 'Kas / akun berhasil dihapus.');
    }
}
