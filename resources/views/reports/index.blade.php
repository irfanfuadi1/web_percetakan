@extends('layouts.app')

@section('title', 'Pusat Laporan')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Pusat Laporan
            </h4>

            <p class="text-muted mb-0">
                Akses semua laporan keuangan dan operasional bisnis Anda di sini.
            </p>

        </div>


        {{-- ========================================= --}}
        {{-- KEUANGAN & AKUNTANSI --}}
        {{-- ========================================= --}}

        <div class="mb-4">

            <div class="d-flex align-items-center mb-2">

                <h5 class="mb-0 fw-semibold text-primary">
                    Keuangan &amp; Akuntansi
                </h5>

            </div>

            <hr class="mt-2 mb-4">


            <div class="row g-3">


                {{-- ARUS KAS --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.cash-flow.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-success">

                                    <i class="bi bi-wallet2"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Arus Kas
                                </h5>

                                <p class="text-muted small mb-0">

                                    Laporan keluar masuk uang dan
                                    rekonsiliasi kas.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>


                {{-- LABA RUGI --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.profit-loss.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-primary">

                                    <i class="bi bi-graph-up-arrow"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Laba Rugi
                                </h5>

                                <p class="text-muted small mb-0">

                                    Analisis pendapatan, biaya,
                                    dan keuntungan bersih.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>


                {{-- PIUTANG --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.receivables.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-warning">

                                    <i class="bi bi-journal-arrow-down"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Piutang (Receivable)
                                </h5>

                                <p class="text-muted small mb-0">

                                    Daftar tagihan customer yang
                                    belum dibayar.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>


                {{-- HUTANG --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.payables.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-danger">

                                    <i class="bi bi-journal-arrow-up"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Hutang (Payable)
                                </h5>

                                <p class="text-muted small mb-0">

                                    Daftar tagihan supplier yang
                                    harus dibayar.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>



        {{-- ========================================= --}}
        {{-- OPERASIONAL & STOK --}}
        {{-- ========================================= --}}

        <div class="mb-4">

            <div class="d-flex align-items-center mb-2">

                <h5 class="mb-0 fw-semibold text-primary">
                    Operasional &amp; Stok
                </h5>

            </div>

            <hr class="mt-2 mb-4">


            <div class="row g-3">


                {{-- PENJUALAN --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.sales.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-info">

                                    <i class="bi bi-cart-check"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Penjualan
                                </h5>

                                <p class="text-muted small mb-0">

                                    Detail transaksi penjualan
                                    order dan project.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>


                {{-- PEMBELIAN --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.purchases.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-secondary">

                                    <i class="bi bi-bag"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Pembelian
                                </h5>

                                <p class="text-muted small mb-0">

                                    Riwayat belanja stok dan
                                    bahan baku.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>


                {{-- STOK & ASET --}}
                <div class="col-xl-3 col-md-6">

                    <a href="{{ route('reports.stock.index') }}"
                       class="text-decoration-none">

                        <div class="card report-card border-0 shadow-sm h-100">

                            <div class="card-body text-center p-4">

                                <div class="report-icon text-primary">

                                    <i class="bi bi-box-seam"></i>

                                </div>

                                <h5 class="fw-semibold text-dark mb-2">
                                    Stok &amp; Aset
                                </h5>

                                <p class="text-muted small mb-0">

                                    Posisi stok gudang, nilai aset,
                                    dan kartu stok.

                                </p>

                            </div>

                        </div>

                    </a>

                </div>

            </div>

        </div>

    </div>


    {{-- STYLE --}}
    <style>

        .report-card {
            transition: all 0.2s ease;
            border-radius: 12px;
        }

        .report-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.08) !important;
        }

        .report-icon {
            width: 64px;
            height: 64px;
            margin: 0 auto 14px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 42px;
        }

    </style>

@endsection