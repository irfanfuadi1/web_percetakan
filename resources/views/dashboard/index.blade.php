@extends('layouts.app')

@section('title', 'Percetakan Gemiprint')

@section('content')

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

            <button class="btn btn-danger btn-sm">
                <i class="bi bi-power me-1"></i>
                Tutup Kasir
            </button>

            <a href="#" class="btn btn-primary btn-sm">
                <i class="bi bi-plus-lg me-1"></i>
                Pesanan Baru
            </a>

        </div>

    </div>


    {{-- STATISTIK --}}
    <div class="row g-3 mb-4">

        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>
                            <p class="text-muted small mb-1">
                                Pelanggan Baru
                            </p>

                            <h4 class="fw-bold mb-0">
                                2
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


        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Pesanan Baru
                            </p>

                            <h4 class="fw-bold mb-0">
                                7
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


        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Penjualan
                            </p>

                            <h4 class="fw-bold mb-0">
                                Rp 1.475.000
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


        <div class="col-xl-3 col-md-6">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between">

                        <div>

                            <p class="text-muted small mb-1">
                                Total Pelanggan
                            </p>

                            <h4 class="fw-bold mb-0">
                                25
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


    {{-- STATUS PESANAN --}}
    <div class="card border-0 shadow-sm mb-4">

        <div class="card-body">

            <h6 class="fw-bold mb-3">
                Status Pesanan
            </h6>

            <div class="row g-3">

                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Proses
                        </small>

                        <h4 class="text-primary fw-bold mt-2 mb-0">
                            3
                        </h4>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Selesai
                        </small>

                        <h4 class="text-success fw-bold mt-2 mb-0">
                            5
                        </h4>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Belum Bayar
                        </small>

                        <h4 class="text-danger fw-bold mt-2 mb-0">
                            1
                        </h4>

                    </div>

                </div>

                <div class="col-md-3">

                    <div class="text-center border rounded p-3">

                        <small class="text-muted">
                            Lunas
                        </small>

                        <h4 class="text-success fw-bold mt-2 mb-0">
                            4
                        </h4>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <div class="row g-4">

        {{-- TRANSAKSI --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <div class="d-flex justify-content-between mb-3">

                        <h6 class="fw-bold mb-0">
                            Transaksi Terakhir
                        </h6>

                        <a href="#" class="small text-primary">
                            Lihat Semua
                        </a>

                    </div>

                    <div class="table-responsive">

                        <table class="table table-hover align-middle mb-0">

                            <thead>

                                <tr>

                                    <th>No. Invoice</th>
                                    <th>Pelanggan</th>
                                    <th>Total</th>
                                    <th>Status</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>
                                        INV-260921-001
                                    </td>

                                    <td>
                                        Budi
                                    </td>

                                    <td>
                                        Rp 250.000
                                    </td>

                                    <td>
                                        <span class="badge bg-success">
                                            Lunas
                                        </span>
                                    </td>

                                </tr>

                                <tr>

                                    <td>
                                        INV-260921-002
                                    </td>

                                    <td>
                                        Andi
                                    </td>

                                    <td>
                                        Rp 150.000
                                    </td>

                                    <td>
                                        <span class="badge bg-warning text-dark">
                                            DP
                                        </span>
                                    </td>

                                </tr>

                                <tr>

                                    <td>
                                        INV-260921-003
                                    </td>

                                    <td>
                                        Irfan
                                    </td>

                                    <td>
                                        Rp 350.000
                                    </td>

                                    <td>
                                        <span class="badge bg-primary">
                                            Proses
                                        </span>
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>


        {{-- STOK --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body">

                    <h6 class="fw-bold mb-3">
                        Stok Menipis
                    </h6>

                    <div class="border rounded p-3 mb-2">

                        <div class="d-flex justify-content-between">

                            <div>
                                <strong>Banner</strong>

                                <br>

                                <small class="text-muted">
                                    Stok tersisa
                                </small>
                            </div>

                            <span class="badge bg-danger">
                                3
                            </span>

                        </div>

                    </div>

                    <div class="border rounded p-3">

                        <div class="d-flex justify-content-between">

                            <div>
                                <strong>Kertas A3</strong>

                                <br>

                                <small class="text-muted">
                                    Stok tersisa
                                </small>
                            </div>

                            <span class="badge bg-warning text-dark">
                                5
                            </span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
