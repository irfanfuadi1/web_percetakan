@extends('layouts.app')

@section('title', 'Laporan Arus Kas')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Laporan Arus Kas
                </h4>

                <p class="text-muted mb-0">
                    Laporan keluar masuk uang berdasarkan transaksi bisnis.
                </p>

            </div>


            <div class="d-flex gap-2">

                <a href="{{ route('cash-accounts.index') }}" class="btn btn-light border">

                    <i class="bi bi-calculator me-1"></i>

                    Rekonsiliasi Kas

                </a>


                <button type="button" class="btn btn-light border" onclick="window.print()">

                    <i class="bi bi-printer me-1"></i>

                    Cetak

                </button>

            </div>

        </div>


        {{-- ALERT --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif


        {{-- RINGKASAN --}}
        <div class="row g-3 mb-4">


            {{-- TOTAL MASUK --}}
            <div class="col-xl-4 col-md-6">

                <div class="card cash-summary-card cash-in border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="small mb-2">
                            Total Masuk
                        </div>

                        <h4 class="fw-bold mb-0">

                            Rp
                            {{ number_format($totalIn, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>


            {{-- TOTAL KELUAR --}}
            <div class="col-xl-4 col-md-6">

                <div class="card cash-summary-card cash-out border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="small mb-2">
                            Total Keluar
                        </div>

                        <h4 class="fw-bold mb-0">

                            Rp
                            {{ number_format($totalOut, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>


            {{-- NET FLOW --}}
            <div class="col-xl-4 col-md-12">

                <div class="card cash-summary-card cash-net border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="small mb-2">
                            Net Flow (Periode Ini)
                        </div>

                        <h4 class="fw-bold mb-0">

                            Rp
                            {{ number_format($netFlow, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>

        </div>


        {{-- FILTER --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <form action="{{ route('reports.cash-flow.index') }}" method="GET">

                    <div class="row g-3 align-items-end">


                        {{-- DARI TANGGAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Dari Tanggal
                            </label>

                            <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}"
                                required>

                        </div>


                        {{-- SAMPAI TANGGAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Sampai Tanggal
                            </label>

                            <input type="date" name="to_date" class="form-control" value="{{ $toDate }}" required>

                        </div>


                        {{-- FILTER BUTTON --}}
                        <div class="col-md-4">

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a href="{{ route('reports.cash-flow.index') }}" class="btn btn-light border ms-1">

                                <i class="bi bi-arrow-clockwise me-1"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- PERIODE --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <div>

                <h6 class="fw-bold mb-1">
                    Detail Arus Kas
                </h6>

                <small class="text-muted">

                    Periode:

                    {{ \Carbon\Carbon::parse($fromDate)->format('d/m/Y') }}

                    -

                    {{ \Carbon\Carbon::parse($toDate)->format('d/m/Y') }}

                </small>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="px-4">
                                    TANGGAL
                                </th>

                                <th>
                                    AKUN KAS
                                </th>

                                <th>
                                    TIPE
                                </th>

                                <th>
                                    KETERANGAN
                                </th>

                                <th class="text-end pe-4">
                                    JUMLAH
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($cashFlows as $flow)
                                <tr>

                                    {{-- TANGGAL --}}
                                    <td class="px-4">

                                        <div class="fw-semibold">

                                            {{ $flow['date']->format('d/m/Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $flow['date']->format('H:i') }}

                                        </small>

                                    </td>


                                    {{-- AKUN KAS --}}
                                    <td>

                                        <span class="badge rounded-pill bg-secondary-subtle text-secondary">

                                            {{ $flow['cash_account'] }}

                                        </span>

                                    </td>


                                    {{-- TIPE --}}
                                    <td>

                                        @if ($flow['type'] === 'Masuk')
                                            <span class="badge rounded-pill bg-success-subtle text-success">

                                                <i class="bi bi-arrow-down-circle me-1"></i>

                                                Masuk

                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-danger-subtle text-danger">

                                                <i class="bi bi-arrow-up-circle me-1"></i>

                                                Keluar

                                            </span>
                                        @endif

                                    </td>


                                    {{-- KETERANGAN --}}
                                    <td>

                                        {{ $flow['description'] }}

                                    </td>


                                    {{-- JUMLAH --}}
                                    <td class="text-end pe-4">

                                        @if ($flow['type'] === 'Masuk')
                                            <span class="fw-semibold text-success">

                                                + Rp
                                                {{ number_format($flow['amount'], 0, ',', '.') }}

                                            </span>
                                        @else
                                            <span class="fw-semibold text-danger">

                                                - Rp
                                                {{ number_format($flow['amount'], 0, ',', '.') }}

                                            </span>
                                        @endif

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="5" class="text-center py-5">

                                        <i class="bi bi-wallet2 fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">

                                            Belum ada arus kas

                                        </div>

                                        <small class="text-muted">

                                            Tidak ada transaksi kas pada periode
                                            yang dipilih.

                                        </small>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- PAGINATION --}}
        <div class="mt-3">

            {{ $cashFlows->links() }}

        </div>

    </div>


    {{-- STYLE --}}
    <style>
        .cash-summary-card {
            border-radius: 12px;
            color: #ffffff;
        }

        .cash-in {
            background: #10b981;
        }

        .cash-out {
            background: #ef4444;
        }

        .cash-net {
            background: #6257e8;
        }

        @media print {

            body {
                background: #ffffff !important;
            }

            .sidebar,
            .navbar,
            .btn,
            form,
            .pagination {
                display: none !important;
            }

            .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }

        }
    </style>

@endsection
