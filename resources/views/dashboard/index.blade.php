@extends('layouts.app')

@section('title', 'Percetakan Gemiprint')

@section('content')

<div class="container-fluid">

    {{-- =====================================================
        HEADER
    ====================================================== --}}

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Dashboard
            </h4>

            <p class="text-muted mb-0 small">
                Ringkasan aktivitas percetakan hari ini
            </p>

        </div>


        <div class="d-flex gap-2">

            <button
                type="button"
                class="btn btn-danger btn-sm"
                disabled
            >
                <i class="bi bi-power me-1"></i>
                Tutup Kasir
            </button>


            <a
                href="{{ route('orders.create') }}"
                class="btn btn-primary btn-sm"
            >
                <i class="bi bi-plus-lg me-1"></i>
                Pesanan Baru
            </a>

        </div>

    </div>


    {{-- =====================================================
        STATISTIK
    ====================================================== --}}

    <div class="row g-3 mb-4">


        {{-- PELANGGAN BARU --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Pelanggan Baru
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ number_format($newCustomersToday, 0, ',', '.') }}
                            </h4>

                            <small class="text-muted">
                                Hari ini
                            </small>

                        </div>


                        <div class="text-primary fs-3">

                            <i class="bi bi-people"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PESANAN BARU --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Pesanan Baru
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ number_format($newOrdersToday, 0, ',', '.') }}
                            </h4>

                            <small class="text-muted">
                                Hari ini
                            </small>

                        </div>


                        <div class="text-success fs-3">

                            <i class="bi bi-cart-check"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- PENJUALAN --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Penjualan
                            </p>

                            <h4 class="fw-bold mb-0">
                                Rp {{ number_format($monthlySales, 0, ',', '.') }}
                            </h4>

                            <small class="text-muted">
                                Bulan ini
                            </small>

                        </div>


                        <div class="text-warning fs-3">

                            <i class="bi bi-currency-dollar"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL PELANGGAN --}}
        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Total Pelanggan
                            </p>

                            <h4 class="fw-bold mb-0">
                                {{ number_format($totalCustomers, 0, ',', '.') }}
                            </h4>

                            <small class="text-muted">
                                Terdaftar
                            </small>

                        </div>


                        <div class="text-info fs-3">

                            <i class="bi bi-person-vcard"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        STATUS PESANAN
    ====================================================== --}}

    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <h6 class="fw-bold mb-3">
                Status Pesanan
            </h6>


            <div class="row g-3">


                {{-- DIPROSES --}}
                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Proses
                        </small>

                        <h4 class="text-primary fw-bold mt-2 mb-0">
                            {{ number_format($processingOrders, 0, ',', '.') }}
                        </h4>

                    </div>

                </div>


                {{-- SELESAI --}}
                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Selesai
                        </small>

                        <h4 class="text-success fw-bold mt-2 mb-0">
                            {{ number_format($completedOrders, 0, ',', '.') }}
                        </h4>

                    </div>

                </div>


                {{-- BELUM BAYAR --}}
                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Belum Bayar
                        </small>

                        <h4 class="text-danger fw-bold mt-2 mb-0">
                            {{ number_format($unpaidOrders, 0, ',', '.') }}
                        </h4>

                    </div>

                </div>


                {{-- LUNAS --}}
                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Lunas
                        </small>

                        <h4 class="text-success fw-bold mt-2 mb-0">
                            {{ number_format($paidOrders, 0, ',', '.') }}
                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- =====================================================
        BOTTOM CONTENT
    ====================================================== --}}

    <div class="row g-4">


        {{-- =================================================
            TRANSAKSI TERAKHIR
        ================================================== --}}

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-clock-history me-1"></i>

                            Transaksi Terakhir

                        </h6>


                        <a
                            href="{{ route('orders.index') }}"
                            class="small text-primary text-decoration-none"
                        >
                            Lihat Semua
                        </a>

                    </div>


                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>
                                        No. Invoice
                                    </th>

                                    <th>
                                        Pelanggan
                                    </th>

                                    <th>
                                        Total
                                    </th>

                                    <th>
                                        Status
                                    </th>

                                    <th class="text-center">
                                        Aksi
                                    </th>

                                </tr>

                            </thead>


                            <tbody>

                                @forelse ($latestOrders as $order)

                                    @php

                                        $total =
                                            (float) $order->total;

                                        $paid =
                                            (float) $order->paid;

                                    @endphp


                                    <tr>

                                        {{-- INVOICE --}}
                                        <td>

                                            <span class="fw-semibold">

                                                {{ $order->invoice_code }}

                                            </span>

                                        </td>


                                        {{-- CUSTOMER --}}
                                        <td>

                                            {{ $order->customer->name ?? '-' }}

                                        </td>


                                        {{-- TOTAL --}}
                                        <td>

                                            Rp
                                            {{ number_format($total, 0, ',', '.') }}

                                        </td>


                                        {{-- STATUS PEMBAYARAN --}}
                                        <td>

                                            @if ($order->status === 'Dibatalkan')

                                                <span class="badge bg-danger">
                                                    Dibatalkan
                                                </span>

                                            @elseif ($total > 0 && $paid >= $total)

                                                <span class="badge bg-success">
                                                    Lunas
                                                </span>

                                            @elseif ($paid > 0)

                                                <span class="badge bg-warning text-dark">
                                                    DP
                                                </span>

                                            @else

                                                <span class="badge bg-secondary">
                                                    Belum Bayar
                                                </span>

                                            @endif

                                        </td>


                                        {{-- DETAIL --}}
                                        <td class="text-center">

                                            <a
                                                href="{{ route('invoice-project.show', $order) }}"
                                                class="btn btn-sm btn-light border"
                                                title="Lihat Invoice"
                                            >

                                                <i class="bi bi-eye"></i>

                                            </a>

                                        </td>

                                    </tr>

                                @empty

                                    <tr>

                                        <td
                                            colspan="5"
                                            class="text-center py-4 text-muted"
                                        >

                                            <i class="bi bi-inbox fs-3 d-block mb-2"></i>

                                            Belum ada transaksi.

                                        </td>

                                    </tr>

                                @endforelse

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- =================================================
            STOK MENIPIS
        ================================================== --}}

        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-3">

                        <h6 class="fw-bold mb-0">

                            <i class="bi bi-exclamation-triangle text-danger me-1"></i>

                            Stok Menipis

                        </h6>

                        <small class="text-muted">
                            ≤ {{ $lowStockLimit }}
                        </small>

                    </div>


                    @forelse ($lowStockProducts as $product)

                        <div class="border rounded p-3 mb-2">

                            <div class="d-flex justify-content-between align-items-center">

                                <div>

                                    <strong>
                                        {{ $product->name }}
                                    </strong>

                                    <br>

                                    <small class="text-muted">
                                        Stok tersisa
                                    </small>

                                </div>


                                @if ($product->stock <= 0)

                                    <span class="badge bg-danger">
                                        Habis
                                    </span>

                                @elseif ($product->stock <= 3)

                                    <span class="badge bg-danger">
                                        {{ number_format($product->stock, 0, ',', '.') }}
                                    </span>

                                @else

                                    <span class="badge bg-warning text-dark">
                                        {{ number_format($product->stock, 0, ',', '.') }}
                                    </span>

                                @endif

                            </div>

                        </div>

                    @empty

                        <div class="text-center text-muted py-4">

                            <i class="bi bi-check-circle text-success fs-3 d-block mb-2"></i>

                            Semua stok masih aman.

                        </div>

                    @endforelse


                    <a
                        href="{{ route('products.index') }}"
                        class="btn btn-sm btn-outline-primary w-100 mt-2"
                    >

                        <i class="bi bi-box-seam me-1"></i>

                        Kelola Stok

                    </a>

                </div>

            </div>


            {{-- =================================================
                PRODUK TERLARIS
            ================================================== --}}

            <div class="card border-0 shadow-sm mt-4">

                <div class="card-body">

                    <h6 class="fw-bold mb-3">

                        <i class="bi bi-trophy me-1"></i>

                        Produk Terlaris
                        <small class="text-muted">
                            (bulan ini)
                        </small>

                    </h6>


                    @forelse ($topProducts as $index => $product)

                        <div
                            class="d-flex justify-content-between align-items-center py-2
                            {{ !$loop->last ? 'border-bottom' : '' }}"
                        >

                            <div class="d-flex align-items-center">

                                <span
                                    class="text-muted me-3"
                                    style="width: 18px;"
                                >
                                    {{ $index + 1 }}
                                </span>


                                <strong>
                                    {{ $product->name }}
                                </strong>

                            </div>


                            <span class="text-muted small">

                                {{ number_format((float) $product->sold_quantity, 0, ',', '.') }}

                                Terjual

                            </span>

                        </div>

                    @empty

                        <div class="text-center text-muted py-3">

                            Belum ada data penjualan bulan ini.

                        </div>

                    @endforelse

                </div>

            </div>

        </div>

    </div>

</div>

@endsection