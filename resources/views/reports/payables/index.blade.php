@extends('layouts.app')

@section('title', 'Laporan Hutang')

@section('content')

    <div class="container-fluid">

        {{-- =========================================================
             HEADER
             ========================================================= --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Laporan Hutang (Payable)
                </h4>

                <p class="text-muted mb-0">
                    Daftar tagihan supplier yang belum dibayar.
                </p>

            </div>


            <button type="button" class="btn btn-light border" onclick="window.print()">

                <i class="bi bi-printer me-1"></i>

                Cetak

            </button>

        </div>


        {{-- =========================================================
             SUMMARY
             ========================================================= --}}

        <div class="row g-3 mb-4">

            {{-- TOTAL HUTANG --}}
            <div class="col-md-6">

                <div class="card payable-card payable-total border-0 shadow-sm">

                    <div class="card-body">

                        <div class="small mb-2">
                            Total Hutang Belum Terbayar
                        </div>

                        <h4 class="fw-bold mb-0">

                            Rp
                            {{ number_format($totalPayable, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>


            {{-- JUMLAH PEMBELIAN --}}
            <div class="col-md-6">

                <div class="card payable-card payable-invoices border-0 shadow-sm">

                    <div class="card-body">

                        <div class="small mb-2">
                            Jumlah Pembelian Gantung
                        </div>

                        <h4 class="fw-bold mb-0">

                            {{ number_format($totalOutstandingPurchases, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
             TABLE
             ========================================================= --}}

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
                                    KODE PEMBELIAN
                                </th>

                                <th>
                                    SUPPLIER
                                </th>

                                <th>
                                    STATUS
                                </th>

                                <th class="text-end">
                                    TOTAL TAGIHAN
                                </th>

                                <th class="text-end">
                                    SUDAH BAYAR
                                </th>

                                <th class="text-end">
                                    SISA HUTANG
                                </th>

                                <th class="text-center">
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($purchases as $purchase)

                                @php

                                    $totalTagihan = (float) $purchase->total;

                                    $sudahBayar = (float) $purchase->paid;

                                    $sisaHutang = $totalTagihan - $sudahBayar;

                                @endphp


                                <tr>

                                    {{-- TANGGAL --}}
                                    <td class="px-4">

                                        <div class="fw-semibold">

                                            {{ $purchase->purchase_date->format('d/m/Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $purchase->purchase_date->format('H:i') }}

                                        </small>

                                    </td>


                                    {{-- KODE PEMBELIAN --}}
                                    <td>

                                        <span class="fw-semibold">

                                            {{ $purchase->purchase_code }}

                                        </span>

                                    </td>


                                    {{-- SUPPLIER --}}
                                    <td>

                                        @if ($purchase->supplier)
                                            <div class="fw-semibold">

                                                {{ $purchase->supplier->name }}

                                            </div>

                                            @if ($purchase->supplier->phone)
                                                <small class="text-muted">

                                                    <i class="bi bi-telephone me-1"></i>

                                                    {{ $purchase->supplier->phone }}

                                                </small>
                                            @endif
                                        @else
                                            <span class="text-muted">
                                                -
                                            </span>
                                        @endif

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if ($sudahBayar <= 0)
                                            <span class="badge rounded-pill bg-danger">

                                                BELUM BAYAR

                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-primary">

                                                DP

                                            </span>
                                        @endif

                                    </td>


                                    {{-- TOTAL TAGIHAN --}}
                                    <td class="text-end">

                                        <span class="fw-semibold">

                                            Rp
                                            {{ number_format($totalTagihan, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- SUDAH BAYAR --}}
                                    <td class="text-end">

                                        <span class="text-success fw-semibold">

                                            Rp
                                            {{ number_format($sudahBayar, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- SISA HUTANG --}}
                                    <td class="text-end">

                                        <span class="text-danger fw-semibold">

                                            Rp
                                            {{ number_format($sisaHutang, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-center">

                                        <a href="{{ route('purchases.show', $purchase) }}"
                                            class="btn btn-sm btn-outline-primary" title="Detail Pembelian">

                                            <i class="bi bi-receipt"></i>

                                        </a>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">

                                        <i class="bi bi-wallet2 fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">

                                            Tidak ada hutang

                                        </div>

                                        <small class="text-muted">

                                            Semua tagihan supplier
                                            sudah dibayar.

                                        </small>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}
            @if ($purchases->hasPages())
                <div class="card-footer bg-white border-0">

                    {{ $purchases->links() }}

                </div>
            @endif

        </div>

    </div>


    {{-- =========================================================
         STYLE
         ========================================================= --}}

    <style>
        .payable-card {
            border-radius: 12px;
            color: #ffffff;
        }

        .payable-card .card-body {
            padding: 18px 20px;
        }

        .payable-card h4 {
            font-size: 24px;
        }

        .payable-total {
            background: #f59e0b;
        }

        .payable-invoices {
            background: #ef4444;
        }

        .table thead th {
            font-size: 12px;
            color: #6c757d;
            font-weight: 700;
            white-space: nowrap;
            background: #f8f9fa;
        }

        .table tbody td {
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #fafafa;
        }


        @media (max-width: 992px) {

            .table {
                min-width: 1100px;
            }

        }


        @media print {

            body {
                background: #ffffff !important;
            }

            .sidebar,
            .navbar,
            .btn,
            .pagination {
                display: none !important;
            }

            .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
            }

            .card {
                box-shadow: none !important;
                border: 1px solid #dddddd !important;
            }

            .payable-card {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

        }
    </style>

@endsection
