@extends('layouts.app')

@section('title', 'Detail Pembelian')

@section('content')

<div class="container-fluid">

    @php
        $remaining =
            $purchase->total -
            $purchase->paid;
    @endphp


    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Detail Pembelian
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap transaksi pembelian.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('purchases.index') }}"
               class="btn btn-light border">

                <i class="bi bi-arrow-left me-1"></i>

                Kembali

            </a>

            <a href="{{ route(
                'purchases.edit',
                $purchase
            ) }}"
               class="btn btn-warning">

                <i class="bi bi-pencil me-1"></i>

                Edit

            </a>

        </div>

    </div>


    <div class="row g-4">

        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between mb-4">

                        <div>

                            <div class="text-muted small">
                                KODE PEMBELIAN
                            </div>

                            <h4 class="fw-bold mb-0">
                                {{ $purchase->purchase_code }}
                            </h4>

                        </div>

                        <div class="text-end">

                            <div class="text-muted small">
                                TANGGAL
                            </div>

                            <div class="fw-semibold">
                                {{ $purchase->purchase_date->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>


                    <hr>


                    <div class="row mb-4">

                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                SUPPLIER
                            </div>

                            <div class="fw-semibold">
                                {{ $purchase->supplier->name }}
                            </div>

                            @if($purchase->supplier->phone)

                                <small class="text-muted">
                                    {{ $purchase->supplier->phone }}
                                </small>

                            @endif

                        </div>


                        <div class="col-md-6">

                            <div class="text-muted small mb-1">
                                PRODUK
                            </div>

                            <div class="fw-semibold">
                                {{ $purchase->product->name }}
                            </div>

                        </div>

                    </div>


                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Produk
                                </th>

                                <th class="text-center">
                                    Jumlah
                                </th>

                                <th class="text-end">
                                    Harga Beli
                                </th>

                                <th class="text-end">
                                    Total
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            <tr>

                                <td>
                                    {{ $purchase->product->name }}
                                </td>

                                <td class="text-center">

                                    {{ $purchase->quantity }}
                                    {{ $purchase->unit }}

                                </td>

                                <td class="text-end">

                                    Rp
                                    {{ number_format(
                                        $purchase->price,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                                <td class="text-end fw-semibold">

                                    Rp
                                    {{ number_format(
                                        $purchase->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>

                            </tr>

                        </tbody>

                    </table>


                    @if($purchase->notes)

                        <hr>

                        <div>

                            <div class="text-muted small mb-1">
                                CATATAN
                            </div>

                            <div>
                                {{ $purchase->notes }}
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h6 class="fw-bold mb-4">
                        Ringkasan Pembayaran
                    </h6>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Total Pembelian
                        </span>

                        <strong>

                            Rp
                            {{ number_format(
                                $purchase->total,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Dibayar
                        </span>

                        <strong class="text-success">

                            Rp
                            {{ number_format(
                                $purchase->paid,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    <div class="d-flex justify-content-between border-top pt-3 mb-4">

                        <span class="fw-semibold">
                            Sisa Hutang
                        </span>

                        <strong class="text-danger">

                            Rp
                            {{ number_format(
                                max($remaining, 0),
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    @if($purchase->status === 'LUNAS')

                        <div class="alert alert-success mb-0">

                            <i class="bi bi-check-circle me-2"></i>

                            Pembelian sudah lunas.

                        </div>

                    @else

                        <div class="alert alert-warning mb-0">

                            <i class="bi bi-exclamation-circle me-2"></i>

                            Pembelian belum lunas.

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection