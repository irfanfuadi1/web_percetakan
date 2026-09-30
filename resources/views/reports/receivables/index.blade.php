@extends('layouts.app')

@section('title', 'Laporan Piutang')

@section('content')

    <div class="container-fluid">

        {{-- =========================================================
             HEADER
             ========================================================= --}}

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Laporan Piutang (Receivable)
                </h4>

                <p class="text-muted mb-0">
                    Daftar tagihan pelanggan yang belum dibayar.
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

            {{-- TOTAL PIUTANG --}}
            <div class="col-md-6">

                <div class="card receivable-card receivable-total border-0 shadow-sm">

                    <div class="card-body">

                        <div class="small mb-2">
                            Total Piutang Belum Terbayar
                        </div>

                        <h4 class="fw-bold mb-0">

                            Rp
                            {{ number_format($totalReceivable, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>


            {{-- JUMLAH INVOICE --}}
            <div class="col-md-6">

                <div class="card receivable-card receivable-invoices border-0 shadow-sm">

                    <div class="card-body">

                        <div class="small mb-2">
                            Jumlah Invoice Gantung
                        </div>

                        <h4 class="fw-bold mb-0">

                            {{ number_format($totalOutstandingInvoices, 0, ',', '.') }}

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
                                    INVOICE
                                </th>

                                <th>
                                    PELANGGAN
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
                                    SISA PIUTANG
                                </th>

                                <th class="text-center">
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($orders as $order)

                                @php

                                    $totalTagihan = (float) $order->total;

                                    $sudahBayar = (float) $order->paid;

                                    $sisaPiutang = $totalTagihan - $sudahBayar;

                                @endphp


                                <tr>

                                    {{-- TANGGAL --}}
                                    <td class="px-4">

                                        <div class="fw-semibold">

                                            {{ $order->order_date->format('d/m/Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $order->order_date->format('H:i') }}

                                        </small>

                                    </td>


                                    {{-- INVOICE --}}
                                    <td>

                                        <span class="fw-semibold">

                                            {{ $order->invoice_code }}

                                        </span>

                                    </td>


                                    {{-- PELANGGAN --}}
                                    <td>

                                        @if ($order->customer)
                                            <div class="fw-semibold">

                                                {{ $order->customer->name }}

                                            </div>

                                            @if ($order->customer->phone)
                                                <small class="text-muted">

                                                    <i class="bi bi-clock me-1"></i>

                                                    {{ $order->customer->phone }}

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


                                    {{-- SISA PIUTANG --}}
                                    <td class="text-end">

                                        <span class="text-danger fw-semibold">

                                            Rp
                                            {{ number_format($sisaPiutang, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- AKSI --}}
                                    <td class="text-center">

                                        <a href="{{ route('orders.show', $order) }}" class="btn btn-sm btn-outline-primary"
                                            title="Detail Invoice">

                                            <i class="bi bi-receipt"></i>

                                        </a>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="8" class="text-center py-5">

                                        <i class="bi bi-wallet2 fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">

                                            Tidak ada piutang

                                        </div>

                                        <small class="text-muted">

                                            Semua tagihan pelanggan
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
            @if ($orders->hasPages())
                <div class="card-footer bg-white border-0">

                    {{ $orders->links() }}

                </div>
            @endif

        </div>

    </div>


    {{-- =========================================================
         STYLE
         ========================================================= --}}

    <style>
        .receivable-card {
            border-radius: 12px;
            color: #ffffff;
        }

        .receivable-card .card-body {
            padding: 18px 20px;
        }

        .receivable-card h4 {
            font-size: 24px;
        }

        .receivable-total {
            background: #f59e0b;
        }

        .receivable-invoices {
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

            .receivable-card {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

        }
    </style>

@endsection
