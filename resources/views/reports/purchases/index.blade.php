@extends('layouts.app')

@section('title', 'Laporan Pembelian')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Laporan Pembelian
            </h4>

            <p class="text-muted mb-0">
                Riwayat pembelian stok dan bahan baku dari supplier.
            </p>

        </div>


        {{-- RINGKASAN --}}
        <div class="row g-3 mb-4">

            {{-- TOTAL PEMBELIAN --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="report-summary-icon text-primary">

                                <i class="bi bi-bag-check"></i>

                            </div>

                            <div class="ms-3">

                                <small class="text-muted d-block">
                                    Total Pembelian
                                </small>

                                <h5 class="fw-bold mb-0">

                                    Rp
                                    {{ number_format($totalPurchases, 0, ',', '.') }}

                                </h5>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- TOTAL DIBAYAR --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="report-summary-icon text-success">

                                <i class="bi bi-cash-stack"></i>

                            </div>

                            <div class="ms-3">

                                <small class="text-muted d-block">
                                    Total Dibayar
                                </small>

                                <h5 class="fw-bold mb-0">

                                    Rp
                                    {{ number_format($totalPaid, 0, ',', '.') }}

                                </h5>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- HUTANG --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="report-summary-icon text-warning">

                            <i class="bi bi-wallet2"></i>

                        </div>

                        <div class="ms-3">

                            <small class="text-muted d-block">
                                Hutang
                            </small>

                            <h5 class="fw-bold mb-0">

                                Rp
                                {{ number_format($totalPayable, 0, ',', '.') }}

                            </h5>

                        </div>

                    </div>

                </div>

            </div>


            {{-- JUMLAH TRANSAKSI --}}
            <div class="col-xl-3 col-md-6">

                <div class="card border-0 shadow-sm h-100">

                    <div class="card-body">

                        <div class="d-flex align-items-center">

                            <div class="report-summary-icon text-info">

                                <i class="bi bi-receipt"></i>

                            </div>

                            <div class="ms-3">

                                <small class="text-muted d-block">
                                    Jumlah Transaksi
                                </small>

                                <h5 class="fw-bold mb-0">

                                    {{ number_format($totalTransactions, 0, ',', '.') }}

                                    <span class="fs-6 fw-normal text-muted">
                                        transaksi
                                    </span>

                                </h5>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FILTER TANGGAL --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <form action="{{ route('reports.purchases.index') }}" method="GET">

                    <div class="row g-3 align-items-end">

                        {{-- DARI TANGGAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Dari Tanggal
                            </label>

                            <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">

                        </div>


                        {{-- SAMPAI TANGGAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Sampai Tanggal
                            </label>

                            <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">

                        </div>


                        {{-- BUTTON --}}
                        <div class="col-md-4">

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a href="{{ route('reports.purchases.index') }}" class="btn btn-light border ms-1">

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
                    Detail Pembelian
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
                                    KODE PEMBELIAN
                                </th>

                                <th>
                                    TANGGAL
                                </th>

                                <th>
                                    SUPPLIER
                                </th>

                                <th>
                                    PRODUK
                                </th>

                                <th>
                                    TOTAL
                                </th>

                                <th>
                                    DIBAYAR
                                </th>

                                <th>
                                    STATUS
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($purchases as $purchase)
                                <tr>

                                    {{-- KODE PEMBELIAN --}}
                                    <td class="px-4">

                                        <div class="fw-semibold">

                                            {{ $purchase->purchase_code }}

                                        </div>

                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>

                                        <div>

                                            {{ $purchase->purchase_date->format('d/m/Y') }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $purchase->purchase_date->format('H:i') }}

                                        </small>

                                    </td>


                                    {{-- SUPPLIER --}}
                                    <td>

                                        {{ $purchase->supplier->name }}

                                    </td>


                                    {{-- PRODUK --}}
                                    <td>

                                        <div class="fw-semibold">

                                            {{ $purchase->product->name }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $purchase->quantity }}
                                            {{ $purchase->unit }}

                                        </small>

                                    </td>


                                    {{-- TOTAL --}}
                                    <td>

                                        <span class="fw-semibold">

                                            Rp
                                            {{ number_format($purchase->total, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    {{-- DIBAYAR --}}
                                    <td>

                                        Rp
                                        {{ number_format($purchase->paid, 0, ',', '.') }}

                                    </td>


                                    {{-- STATUS --}}
                                    <td>

                                        @if ($purchase->status === 'LUNAS')
                                            <span class="badge rounded-pill bg-success-subtle text-success">
                                                LUNAS
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-warning-subtle text-warning">
                                                BELUM LUNAS
                                            </span>
                                        @endif

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="7" class="text-center py-5">

                                        <i class="bi bi-bar-chart-line fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">
                                            Belum ada transaksi pembelian
                                        </div>

                                        <small class="text-muted">

                                            Tidak ada transaksi pada periode
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

            {{ $purchases->links() }}

        </div>

    </div>


    {{-- STYLE --}}
    <style>
        .report-summary-icon {
            width: 48px;
            height: 48px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 28px;
        }
    </style>

@endsection
