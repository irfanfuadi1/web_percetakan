@extends('layouts.app')

@section('title', 'Detail Pengeluaran')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Detail Pengeluaran
                </h4>

                <p class="text-muted mb-0">
                    Informasi transaksi pengeluaran operasional.
                </p>

            </div>

            <div class="d-flex gap-2">

                
                <a href="{{ route('expenses.index') }}" class="btn btn-light border">
                    
                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali
                    
                </a>
                
                <a href="{{ route('expenses.edit', $expense) }}" class="btn btn-warning">

                    <i class="bi bi-pencil me-1"></i>

                    Edit

                </a>
            </div>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="text-muted small">
                            Tanggal
                        </label>

                        <div class="fw-semibold">
                            {{ $expense->expense_date->format('d/m/Y') }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="text-muted small">
                            Akun Kas
                        </label>

                        <div class="fw-semibold">
                            {{ $expense->cashAccount->name }}
                        </div>

                        <small class="text-muted">
                            {{ $expense->cashAccount->type }}
                        </small>

                    </div>


                    <div class="col-md-6">

                        <label class="text-muted small">
                            Keterangan
                        </label>

                        <div class="fw-semibold">
                            {{ $expense->description }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="text-muted small">
                            Jumlah Pengeluaran
                        </label>

                        <div class="fw-bold fs-5 text-danger">

                            Rp
                            {{ number_format($expense->amount, 0, ',', '.') }}

                        </div>

                    </div>


                    <div class="col-12">

                        <label class="text-muted small">
                            Catatan
                        </label>

                        <div>

                            @if ($expense->notes)
                                {{ $expense->notes }}
                            @else
                                <span class="text-muted">
                                    Tidak ada catatan.
                                </span>
                            @endif

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
