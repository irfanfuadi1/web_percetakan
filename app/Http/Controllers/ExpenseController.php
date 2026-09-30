<?php

namespace App\Http\Controllers;

use App\Models\CashAccount;
use App\Models\Expense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
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

        $expenses = Expense::with('cashAccount')
            ->whereBetween('expense_date', [$fromDate, $toDate])
            ->latest('expense_date')
            ->latest('id')
            ->paginate(10)
            ->withQueryString();

        $totalExpense = Expense::whereBetween(
            'expense_date',
            [$fromDate, $toDate]
        )->sum('amount');

        return view('expenses.index', compact(
            'expenses',
            'totalExpense',
            'fromDate',
            'toDate'
        ));
    }

    public function create()
    {
        $cashAccounts = CashAccount::orderBy('name')->get();

        return view('expenses.create', compact('cashAccounts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'expense_date' => [
                'required',
                'date',
            ],

            'cash_account_id' => [
                'required',
                'exists:cash_accounts,id',
            ],

            'description' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ], [
            'expense_date.required' => 'Tanggal pengeluaran wajib diisi.',
            'cash_account_id.required' => 'Akun kas wajib dipilih.',
            'cash_account_id.exists' => 'Akun kas tidak ditemukan.',
            'description.required' => 'Keterangan wajib diisi.',
            'amount.required' => 'Jumlah pengeluaran wajib diisi.',
            'amount.numeric' => 'Jumlah pengeluaran harus berupa angka.',
            'amount.min' => 'Jumlah pengeluaran tidak boleh kurang dari 0.',
        ]);

        DB::transaction(function () use ($validated) {

            Expense::create($validated);

            CashAccount::where('id', $validated['cash_account_id'])
                ->decrement('balance', $validated['amount']);
        });

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil ditambahkan.');
    }

    public function show(Expense $expense)
    {
        $expense->load('cashAccount');

        return view('expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        $cashAccounts = CashAccount::orderBy('name')->get();

        return view('expenses.edit', compact(
            'expense',
            'cashAccounts'
        ));
    }

    public function update(Request $request, Expense $expense)
    {
        $validated = $request->validate([
            'expense_date' => [
                'required',
                'date',
            ],

            'cash_account_id' => [
                'required',
                'exists:cash_accounts,id',
            ],

            'description' => [
                'required',
                'string',
                'max:255',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'notes' => [
                'nullable',
                'string',
            ],
        ], [
            'expense_date.required' => 'Tanggal pengeluaran wajib diisi.',
            'cash_account_id.required' => 'Akun kas wajib dipilih.',
            'cash_account_id.exists' => 'Akun kas tidak ditemukan.',
            'description.required' => 'Keterangan wajib diisi.',
            'amount.required' => 'Jumlah pengeluaran wajib diisi.',
            'amount.numeric' => 'Jumlah pengeluaran harus berupa angka.',
            'amount.min' => 'Jumlah pengeluaran tidak boleh kurang dari 0.',
        ]);

        DB::transaction(function () use ($validated, $expense) {

            /*
             * Kembalikan saldo pengeluaran lama
             */
            CashAccount::where('id', $expense->cash_account_id)
                ->increment('balance', $expense->amount);

            /*
             * Simpan pengeluaran baru
             */
            $expense->update($validated);

            /*
             * Kurangi saldo akun kas baru
             */
            CashAccount::where('id', $validated['cash_account_id'])
                ->decrement('balance', $validated['amount']);
        });

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil diperbarui.');
    }

    public function destroy(Expense $expense)
    {
        DB::transaction(function () use ($expense) {

            /*
             * Kembalikan saldo akun kas
             */
            CashAccount::where('id', $expense->cash_account_id)
                ->increment('balance', $expense->amount);

            /*
             * Hapus pengeluaran
             */
            $expense->delete();
        });

        return redirect()
            ->route('expenses.index')
            ->with('success', 'Pengeluaran berhasil dihapus.');
    }
}
