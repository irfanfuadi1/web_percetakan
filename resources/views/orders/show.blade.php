@extends('layouts.app')

@section('title', 'Detail Pesanan')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Detail Pesanan
        </h4>

        <p class="text-muted mb-0">
            Informasi lengkap pesanan pelanggan.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row">

                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Kode Invoice
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $order->invoice_code }}
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Tanggal
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $order->order_date->format('d/m/Y H:i') }}
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Pelanggan
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $order->customer->name }}
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Produk
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $order->product->name }}
                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <small class="text-muted">
                        Jumlah
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ rtrim(rtrim(number_format($order->quantity, 2, ',', '.'), '0'), ',') }}
                        {{ $order->unit }}
                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <small class="text-muted">
                        Harga
                    </small>

                    <div class="fw-semibold mt-1">
                        Rp {{ number_format($order->price, 0, ',', '.') }}
                    </div>

                </div>


                <div class="col-md-4 mb-4">

                    <small class="text-muted">
                        Total
                    </small>

                    <div class="fw-bold mt-1">
                        Rp {{ number_format($order->total, 0, ',', '.') }}
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Dibayar
                    </small>

                    <div class="fw-semibold mt-1">
                        Rp {{ number_format($order->paid, 0, ',', '.') }}
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Sisa Pembayaran
                    </small>

                    <div class="fw-semibold mt-1">
                        Rp {{ number_format(max(0, $order->total - $order->paid), 0, ',', '.') }}
                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Status
                    </small>

                    <div class="mt-1">

                        @php
                            $statusClass = match($order->status) {
                                'Menunggu' => 'bg-warning text-dark',
                                'Diproses' => 'bg-primary',
                                'Selesai' => 'bg-success',
                                'Dibatalkan' => 'bg-danger',
                                default => 'bg-secondary',
                            };
                        @endphp

                        <span class="badge {{ $statusClass }}">
                            {{ $order->status }}
                        </span>

                    </div>

                </div>


                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Spesifikasi
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $order->specification ?? '-' }}
                    </div>

                </div>


                <div class="col-12 mb-4">

                    <small class="text-muted">
                        File Desain
                    </small>

                    <div class="mt-2">

                        @if($order->file_path)

                            <a href="{{ asset('storage/' . $order->file_path) }}"
                               target="_blank"
                               class="btn btn-outline-primary btn-sm">

                                <i class="bi bi-file-earmark"></i>
                                Lihat File

                            </a>

                        @else

                            <span class="text-muted">
                                Tidak ada file.

                            </span>

                        @endif

                    </div>

                </div>


                <div class="col-12 mb-4">

                    <small class="text-muted">
                        Catatan
                    </small>

                    <div class="mt-1">
                        {{ $order->notes ?? '-' }}
                    </div>

                </div>

            </div>


            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('orders.index') }}"
                   class="btn btn-light border">

                   <i class="bi bi-arrow-left me-1"></i>
                    Kembali

                </a>

                <a href="{{ route('orders.edit', $order) }}"
                   class="btn btn-primary">

                    <i class="bi bi-pencil me-1"></i>
                    Edit

                </a>

            </div>

        </div>

    </div>

</div>

@endsection