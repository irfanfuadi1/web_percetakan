@extends('layouts.app')

@section('title', 'Laporan Stok & Persediaan')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Laporan Stok & Persediaan
                </h4>

                <p class="text-muted mb-0">
                    Pantau stok barang, nilai persediaan, dan riwayat mutasi.
                </p>

            </div>


            <button type="button" class="btn btn-light border" onclick="window.print()">

                <i class="bi bi-printer me-1"></i>

                Cetak

            </button>

        </div>


        {{-- ================================================================
             SUMMARY
             ================================================================ --}}

        <div class="row g-3 mb-4">


            {{-- TOTAL NILAI ASET --}}
            <div class="col-xl-4 col-md-6">

                <div class="card stock-summary-card asset-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="small mb-2">
                            Total Nilai Aset
                        </div>

                        <h4 class="fw-bold mb-0">

                            Rp
                            {{ number_format($totalAssetValue, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>


            {{-- TOTAL ITEM --}}
            <div class="col-xl-4 col-md-6">

                <div class="card stock-summary-card sku-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="small mb-2">
                            Total Item (SKU)
                        </div>

                        <h4 class="fw-bold mb-0">

                            {{ number_format($totalItems, 0, ',', '.') }}

                        </h4>

                    </div>

                </div>

            </div>


            {{-- STOK MENIPIS --}}
            <div class="col-xl-4 col-md-12">

                <div class="card stock-summary-card low-stock-card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="small mb-2">
                            Stok Menipis
                        </div>

                        <h4 class="fw-bold mb-0">

                            {{ number_format($lowStockItems, 0, ',', '.') }}

                            Item

                        </h4>

                        <small>
                            Stok ≤ {{ $lowStockLimit }}
                        </small>

                    </div>

                </div>

            </div>

        </div>


        {{-- ================================================================
             TAB
             ================================================================ --}}

        <div class="card border-0 shadow-sm">

            <div class="card-header bg-white border-0 pt-3 px-3">

                <ul class="nav nav-tabs border-bottom-0">

                    {{-- STOK SAAT INI --}}
                    <li class="nav-item">

                        <a href="{{ route('reports.stock.index', ['tab' => 'current']) }}"
                            class="nav-link {{ $activeTab === 'current' ? 'active' : '' }}">

                            <i class="bi bi-box-seam me-1"></i>

                            Stok Saat Ini

                        </a>

                    </li>


                    {{-- RIWAYAT MUTASI --}}
                    <li class="nav-item">

                        <a href="{{ route('reports.stock.index', ['tab' => 'history']) }}"
                            class="nav-link {{ $activeTab === 'history' ? 'active' : '' }}">

                            <i class="bi bi-clock-history me-1"></i>

                            Riwayat Mutasi (Kartu Stok)

                        </a>

                    </li>

                </ul>

            </div>


            <div class="card-body p-0">


                {{-- ========================================================
                     TAB STOK SAAT INI
                     ======================================================== --}}

                @if ($activeTab === 'current')

                    <div class="table-responsive">

                        <table class="table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th class="px-4">
                                        KODE
                                    </th>

                                    <th>
                                        NAMA ITEM
                                    </th>

                                    <th>
                                        KATEGORI
                                    </th>

                                    <th class="text-center">
                                        STOK
                                    </th>

                                    <th>
                                        SATUAN
                                    </th>

                                    <th class="text-end">
                                        HARGA BELI
                                    </th>

                                    <th class="text-end pe-4">
                                        NILAI ASET
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($products as $product)
                                    @php

                                        $assetValue = (float) $product->stock * (float) $product->purchase_price;
                                    @endphp


                                    <tr>

                                        {{-- KODE --}}
                                        <td class="px-4">

                                            <span class="fw-semibold">
                                                {{ $product->code }}
                                            </span>

                                        </td>


                                        {{-- NAMA --}}
                                        <td>

                                            <span class="fw-semibold">
                                                {{ $product->name }}
                                            </span>

                                        </td>


                                        {{-- KATEGORI --}}
                                        <td>

                                            {{ $product->supplier_category }}

                                        </td>


                                        {{-- STOK --}}
                                        <td class="text-center">

                                            @if ($product->stock <= 0)
                                                <span class="badge rounded-pill bg-danger">

                                                    {{ number_format($product->stock, 0, ',', '.') }}

                                                </span>
                                            @elseif ($product->stock <= $lowStockLimit)
                                                <span class="badge rounded-pill bg-warning text-dark">

                                                    {{ number_format($product->stock, 0, ',', '.') }}

                                                </span>
                                            @else
                                                <span class="fw-semibold">

                                                    {{ number_format($product->stock, 0, ',', '.') }}

                                                </span>
                                            @endif

                                        </td>


                                        {{-- SATUAN --}}
                                        <td>

                                            {{ $product->unit }}

                                        </td>


                                        {{-- HARGA BELI --}}
                                        <td class="text-end">

                                            Rp
                                            {{ number_format($product->purchase_price, 0, ',', '.') }}

                                        </td>


                                        {{-- NILAI ASET --}}
                                        <td class="text-end pe-4">

                                            <span class="fw-semibold">

                                                Rp
                                                {{ number_format($assetValue, 0, ',', '.') }}

                                            </span>

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="7" class="text-center py-5">

                                            <i class="bi bi-box-seam fs-1 text-muted"></i>

                                            <div class="fw-semibold mt-3">

                                                Belum ada data stok

                                            </div>

                                            <small class="text-muted">

                                                Tambahkan item pada Master Item
                                                untuk melihat persediaan.

                                            </small>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>

                @endif


                {{-- ========================================================
                     TAB RIWAYAT MUTASI
                     ======================================================== --}}

                @if ($activeTab === 'history')

                    <div class="table-responsive">

                        <table class="table align-middle mb-0">

                            <thead>

                                <tr>

                                    <th class="px-4">
                                        TANGGAL
                                    </th>

                                    <th>
                                        KODE
                                    </th>

                                    <th>
                                        NAMA ITEM
                                    </th>

                                    <th>
                                        TIPE
                                    </th>

                                    <th>
                                        REFERENSI
                                    </th>

                                    <th class="text-end">
                                        JUMLAH
                                    </th>

                                    <th>
                                        KETERANGAN
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($stockMovements as $movement)
                                    <tr>

                                        {{-- TANGGAL --}}
                                        <td class="px-4">

                                            <div class="fw-semibold">

                                                {{ $movement['date']->format('d/m/Y') }}

                                            </div>

                                            <small class="text-muted">

                                                {{ $movement['date']->format('H:i') }}

                                            </small>

                                        </td>


                                        {{-- KODE --}}
                                        <td>

                                            {{ $movement['code'] }}

                                        </td>


                                        {{-- PRODUK --}}
                                        <td>

                                            <span class="fw-semibold">

                                                {{ $movement['product'] }}

                                            </span>

                                        </td>


                                        {{-- TIPE --}}
                                        <td>

                                            @if ($movement['type'] === 'Masuk')
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


                                        {{-- REFERENSI --}}
                                        <td>

                                            {{ $movement['reference'] }}

                                        </td>


                                        {{-- JUMLAH --}}
                                        <td class="text-end">

                                            @if ($movement['type'] === 'Masuk')
                                                <span class="fw-semibold text-success">

                                                    +
                                                    {{ number_format($movement['quantity'], 2, ',', '.') }}

                                                    {{ $movement['unit'] }}

                                                </span>
                                            @else
                                                <span class="fw-semibold text-danger">

                                                    -
                                                    {{ number_format($movement['quantity'], 2, ',', '.') }}

                                                    {{ $movement['unit'] }}

                                                </span>
                                            @endif

                                        </td>


                                        {{-- KETERANGAN --}}
                                        <td>

                                            {{ $movement['description'] }}

                                        </td>

                                    </tr>


                                @empty

                                    <tr>

                                        <td colspan="7" class="text-center py-5">

                                            <i class="bi bi-clock-history fs-1 text-muted"></i>

                                            <div class="fw-semibold mt-3">

                                                Belum ada riwayat mutasi

                                            </div>

                                            <small class="text-muted">

                                                Belum terdapat transaksi pembelian
                                                atau penjualan.

                                            </small>

                                        </td>

                                    </tr>
                                @endforelse

                            </tbody>

                        </table>

                    </div>


                    {{-- PAGINATION --}}
                    <div class="p-3">

                        {{ $stockMovements->links() }}

                    </div>

                @endif

            </div>

        </div>

    </div>


    {{-- ================================================================
         STYLE
         ================================================================ --}}

    <style>
        .stock-summary-card {
            border-radius: 12px;
            color: #ffffff;
        }

        .asset-card {
            background: #6257e8;
        }

        .sku-card {
            background: #13b5c8;
        }

        .low-stock-card {
            background: #f59e0b;
        }

        .stock-summary-card .card-body {
            padding: 18px 20px;
        }

        .stock-summary-card h4 {
            font-size: 24px;
        }

        .nav-tabs .nav-link {
            color: #6257e8;
            border: 1px solid transparent;
        }

        .nav-tabs .nav-link.active {
            color: #212529;
            background: #ffffff;
            border-color: #dee2e6 #dee2e6 #ffffff;
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


        @media print {

            body {
                background: #ffffff !important;
            }

            .sidebar,
            .navbar,
            .btn,
            .nav-tabs,
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

            .stock-summary-card {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

        }
    </style>

@endsection
