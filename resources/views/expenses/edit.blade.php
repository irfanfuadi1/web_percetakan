@extends('layouts.app')

@section('title', 'Edit Pengeluaran')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Edit Pengeluaran
            </h4>

            <p class="text-muted mb-0">
                Perbarui transaksi pengeluaran operasional.
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('expenses.update', $expense) }}" method="POST">

                    @csrf

                    @method('PUT')


                    <div class="row g-3">

                        {{-- TANGGAL --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Tanggal
                            </label>

                            <input type="date" name="expense_date"
                                class="form-control @error('expense_date') is-invalid @enderror"
                                value="{{ old('expense_date', $expense->expense_date->format('Y-m-d')) }}" required>

                            @error('expense_date')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- AKUN KAS --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Akun Kas <span class="text-danger">*</span>
                            </label>

                            <select name="cash_account_id"
                                class="form-select @error('cash_account_id') is-invalid @enderror" required>

                                <option value="">
                                    Pilih Akun Kas
                                </option>

                                @foreach ($cashAccounts as $cashAccount)
                                    <option value="{{ $cashAccount->id }}"
                                        {{ old('cash_account_id', $expense->cash_account_id) == $cashAccount->id ? 'selected' : '' }}>

                                        {{ $cashAccount->name }}
                                        (Saldo: Rp {{ number_format($cashAccount->balance, 0, ',', '.') }})
                                    </option>
                                @endforeach

                            </select>

                            @error('cash_account_id')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- KETERANGAN --}}
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Keterangan
                            </label>

                            <input type="text" name="description"
                                class="form-control @error('description') is-invalid @enderror"
                                value="{{ old('description', $expense->description) }}" required>

                            @error('description')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- JUMLAH --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Jumlah Pengeluaran
                            </label>

                            <div class="input-group">

                                <span class="input-group-text">
                                    Rp
                                </span>

                                <input type="number" name="amount"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    value="{{ old('amount', $expense->amount) }}" min="0" step="0.01" required>

                            </div>

                            @error('amount')
                                <div class="text-danger small mt-1">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- CATATAN --}}
                        <div class="col-12">

                            <label class="form-label fw-semibold">

                                Catatan

                                <span class="text-muted fw-normal">
                                    (Opsional)
                                </span>

                            </label>

                            <textarea name="notes" class="form-control" rows="3" placeholder="Catatan tambahan...">{{ old('notes', $expense->notes) }}</textarea>

                        </div>

                    </div>


                    <hr class="my-4">


                    {{-- BUTTON --}}
                    <div class="d-flex justify-content-end gap-2">

                        <a href="{{ route('expenses.index') }}" class="btn btn-light border w-50">

                            <i class="bi bi-arrow-left me-1"></i>

                            Kembali

                        </a>


                        <button type="submit" class="btn btn-primary w-50">

                            <i class="bi bi-save me-1"></i>

                            Update Pengeluaran

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
