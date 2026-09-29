@extends('layouts.app')

@section('title', 'Detail Piutang')

@section('content')

<div class="container-fluid">

    @php
        $remaining =
            $order->total -
            $order->paid;
    @endphp


    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Detail Piutang
            </h4>

            <p class="text-muted mb-0">
                Informasi tagihan pelanggan.
            </p>

        </div>

        <div class="d-flex gap-2">

            <a href="{{ route('receivables.index') }}"
               class="btn btn-light border">

                <i class="bi bi-arrow-left me-1"></i>

                Kembali

            </a>

            <a href="{{ route(
                'invoice-project.print',
                $order
            ) }}"
               target="_blank"
               class="btn btn-outline-success">

                <i class="bi bi-printer me-1"></i>

                Cetak Invoice

            </a>

        </div>

    </div>


    <div class="row g-4">

        {{-- DETAIL --}}
        <div class="col-lg-8">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    {{-- INVOICE --}}
                    <div class="d-flex justify-content-between mb-4">

                        <div>

                            <div class="text-muted small">
                                KODE INVOICE
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
                    <table class="table align-middle">

                        <thead>

                            <tr>

                                <th>
                                    Produk
                                </th>

                                <th>
                                    Qty
                                </th>

                                <th class="text-end">
                                    Harga
                                </th>

                                <th class="text-end">
                                    Total
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

                                <td>

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

            </div>

        </div>


        {{-- PAYMENT --}}
        <div class="col-lg-4">

            <div class="card border-0 shadow-sm">

                <div class="card-body p-4">

                    <h6 class="fw-bold mb-4">
                        Ringkasan Piutang
                    </h6>


                    {{-- TOTAL --}}
                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Total
                        </span>

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


                    {{-- PAID --}}
                    <div class="d-flex justify-content-between mb-3">

                        <span class="text-muted">
                            Sudah Dibayar
                        </span>

                        <strong class="text-success">

                            Rp
                            {{ number_format(
                                $order->paid,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    {{-- REMAINING --}}
                    <div class="d-flex justify-content-between border-top pt-3 mb-4">

                        <span class="fw-semibold">
                            Sisa Piutang
                        </span>

                        <strong class="text-danger">

                            Rp
                            {{ number_format(
                                $remaining,
                                0,
                                ',',
                                '.'
                            ) }}

                        </strong>

                    </div>


                    @if($remaining > 0)

                        <form action="{{ route(
                            'receivables.pay',
                            $order
                        ) }}"
                              method="POST">

                            @csrf

                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Pembayaran
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input type="number"
                                           name="payment"
                                           class="form-control @error('payment') is-invalid @enderror"
                                           min="1"
                                           max="{{ $remaining }}"
                                           step="0.01"
                                           value="{{ old('payment') }}"
                                           placeholder="0">

                                </div>

                                @error('payment')

                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>

                                @enderror

                            </div>


                            <button type="submit"
                                    class="btn btn-primary w-100">

                                <i class="bi bi-cash-stack me-1"></i>

                                Catat Pembayaran

                            </button>

                        </form>

                    @else

                        <div class="alert alert-success mb-0">

                            <i class="bi bi-check-circle me-2"></i>

                            Piutang sudah lunas.

                        </div>

                    @endif

                </div>

            </div>

        </div>

    </div>

</div>

@endsection