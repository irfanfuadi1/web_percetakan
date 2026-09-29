@extends('layouts.app')

@section('title', 'Detail Invoice Project')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Detail Invoice Project
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap invoice pelanggan.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('invoice-project.index') }}"
               class="btn btn-light border">

                <i class="bi bi-arrow-left me-1"></i>
                Kembali

            </a>

            <a href="{{ route(
                'invoice-project.print',
                $order
            ) }}"
               target="_blank"
               class="btn btn-success">

                <i class="bi bi-printer me-1"></i>
                Cetak Invoice

            </a>

        </div>

    </div>


    @php
        $remaining =
            $order->total - $order->paid;

        if ($order->paid >= $order->total) {
            $paymentStatus = 'LUNAS';
        } elseif ($order->paid > 0) {
            $paymentStatus = 'DP';
        } else {
            $paymentStatus = 'BELUM LUNAS';
        }
    @endphp


    <div class="row g-4">

        {{-- INVOICE --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between mb-4">

                        <div>

                            <div class="text-muted small">
                                NO. INVOICE
                            </div>

                            <h4 class="fw-bold mb-0">
                                {{ $order->invoice_code }}
                            </h4>

                        </div>


                        <div class="text-end">

                            <div class="text-muted small">
                                TANGGAL
                            </div>

                            <div class="fw-semibold">
                                {{ $order->order_date->format('d/m/Y H:i') }}
                            </div>

                        </div>

                    </div>


                    <hr>


                    {{-- CUSTOMER --}}
                    <div class="mb-4">

                        <div class="text-muted small mb-1">
                            PELANGGAN
                        </div>

                        <div class="fw-semibold">
                            {{ $order->customer->name }}
                        </div>

                        @if($order->customer->phone)
                            <div class="text-muted small">
                                {{ $order->customer->phone }}
                            </div>
                        @endif

                        @if($order->customer->address)
                            <div class="text-muted small">
                                {{ $order->customer->address }}
                            </div>
                        @endif

                    </div>


                    {{-- PRODUCT --}}
                    <div class="table-responsive">

                        <table class="table align-middle">

                            <thead>

                                <tr>

                                    <th>
                                        Nama Project
                                    </th>

                                    <th class="text-center">
                                        Qty
                                    </th>

                                    <th class="text-end">
                                        Harga
                                    </th>

                                    <th class="text-end">
                                        Subtotal
                                    </th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr>

                                    <td>

                                        <div class="fw-semibold">
                                            {{ $order->product->name }}
                                        </div>

                                        @if($order->specification)
                                            <small class="text-muted">
                                                {{ $order->specification }}
                                            </small>
                                        @endif

                                    </td>

                                    <td class="text-center">
                                        {{ $order->quantity }}
                                        {{ $order->unit }}
                                    </td>

                                    <td class="text-end">
                                        Rp
                                        {{ number_format(
                                            $order->price,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </td>

                                    <td class="text-end fw-semibold">
                                        Rp
                                        {{ number_format(
                                            $order->total,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>


                    <div class="row justify-content-end">

                        <div class="col-md-6">

                            <div class="d-flex justify-content-between mb-2">
                                <span>Total</span>

                                <strong>
                                    Rp
                                    {{ number_format(
                                        $order->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <span>Dibayar</span>

                                <strong>
                                    Rp
                                    {{ number_format(
                                        $order->paid,
                                        0,
                                        ',',
                                        '.'
                                    ) }}
                                </strong>
                            </div>

                            <div class="d-flex justify-content-between border-top pt-2">

                                <span class="fw-semibold">
                                    Sisa
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

                        </div>

                    </div>


                    @if($order->notes)

                        <hr>

                        <div>

                            <div class="text-muted small mb-1">
                                CATATAN
                            </div>

                            <div>
                                {{ $order->notes }}
                            </div>

                        </div>

                    @endif

                </div>

            </div>

        </div>


        {{-- STATUS --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h6 class="fw-bold mb-4">
                        Informasi Pembayaran
                    </h6>


                    <div class="mb-3">

                        <div class="text-muted small mb-1">
                            STATUS PEMBAYARAN
                        </div>

                        @if($paymentStatus === 'LUNAS')

                            <span class="badge bg-success-subtle text-success">
                                LUNAS
                            </span>

                        @elseif($paymentStatus === 'DP')

                            <span class="badge bg-warning-subtle text-warning">
                                DP
                            </span>

                        @else

                            <span class="badge bg-danger-subtle text-danger">
                                BELUM LUNAS
                            </span>

                        @endif

                    </div>


                    <div class="mb-3">

                        <div class="text-muted small mb-1">
                            STATUS PESANAN
                        </div>

                        <span class="badge bg-primary-subtle text-primary">
                            {{ $order->status }}
                        </span>

                    </div>


                    <div>

                        <div class="text-muted small mb-1">
                            SISA PEMBAYARAN
                        </div>

                        <h5 class="fw-bold text-danger">
                            Rp
                            {{ number_format(
                                max($remaining, 0),
                                0,
                                ',',
                                '.'
                            ) }}
                        </h5>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection