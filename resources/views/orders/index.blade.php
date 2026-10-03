@extends('layouts.app')

@section('title', 'Pesanan')

@section('content')

<style>
    .order-header {
        margin-bottom: 25px;
    }

    .order-header h4 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .order-header p {
        color: #8b8b98;
        font-size: 13px;
        margin-bottom: 0;
    }

    .order-table-card {
        background: #fff;
        border: 1px solid #eeeeF4;
        border-radius: 10px;
        overflow: hidden;
    }

    .order-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .order-table thead th {
        background: #fafafd;
        border-bottom: 1px solid #eeeeF4;
        color: #777;
        font-size: 11px;
        font-weight: 700;
        padding: 14px 16px;
        white-space: nowrap;
    }

    .order-table tbody td {
        padding: 15px 16px;
        border-color: #f1f1f5;
        font-size: 12px;
        color: #444;
    }

    .invoice-code {
        font-weight: 700;
        color: #333;
    }

    .invoice-date {
        color: #999;
        font-size: 10px;
        margin-top: 3px;
    }

    .customer-name {
        font-weight: 600;
        color: #333;
    }

    .product-name {
        color: #555;
    }

    .amount {
        font-weight: 600;
        white-space: nowrap;
    }

    .status-badge {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-menunggu {
        background: #fff3cd;
        color: #997404;
    }

    .status-diproses {
        background: #e8e5ff;
        color: #6257e8;
    }

    .status-selesai {
        background: #dff8ec;
        color: #15945d;
    }

    .status-dibatalkan {
        background: #ffe5e5;
        color: #dc3545;
    }

    .action-wrapper {
        display: flex;
        gap: 5px;
    }

    .action-btn {
        width: 32px;
        height: 32px;
        border-radius: 7px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e8e8ee;
        background: #fff;
        color: #777;
        text-decoration: none;
        transition: .2s;
    }

    .action-btn:hover {
        background: #f1efff;
        color: #6257e8;
        border-color: #dcd8ff;
    }

    .action-btn.delete:hover {
        background: #fff0f0;
        color: #dc3545;
        border-color: #ffd4d4;
    }

    .empty-order {
        padding: 60px 20px;
        text-align: center;
        color: #999;
    }

    .empty-order i {
        font-size: 40px;
        color: #ccc;
        display: block;
        margin-bottom: 10px;
    }
</style>


<div class="container-fluid">

    {{-- HEADER --}}
    <div class="order-header d-flex justify-content-between align-items-center">

        <div>
            <h4>
                Daftar Pesanan
            </h4>

            <p>
                Kelola pesanan pelanggan dan transaksi penjualan.
            </p>
        </div>

        <a href="{{ route('orders.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Buat Pesanan Baru

        </a>

    </div>


    


    {{-- TABLE --}}
    <div class="order-table-card">

        <div class="table-responsive">

            <table class="table order-table">

                <thead>

                    <tr>

                        <th>
                            Kode Invoice
                        </th>

                        <th>
                            Tanggal
                        </th>

                        <th>
                            Pelanggan
                        </th>

                        <th>
                            Produk
                        </th>

                        <th>
                            Total
                        </th>

                        <th>
                            Dibayar
                        </th>

                        <th>
                            Status
                        </th>

                        <th>
                            Aksi
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($orders as $order)

                        <tr>

                            {{-- INVOICE --}}
                            <td>

                                <div class="invoice-code">
                                    {{ $order->invoice_code }}
                                </div>

                            </td>


                            {{-- TANGGAL --}}
                            <td>

                                <div>
                                    {{ $order->order_date->format('d/m/Y') }}
                                </div>

                                <div class="invoice-date">
                                    {{ $order->order_date->format('H:i') }}
                                </div>

                            </td>


                            {{-- PELANGGAN --}}
                            <td>

                                <div class="customer-name">
                                    {{ $order->customer->name }}
                                </div>

                            </td>


                            {{-- PRODUK --}}
                            <td>

                                <div class="product-name">
                                    {{ $order->product->name }}
                                </div>

                                <small class="text-muted">
                                    {{ rtrim(rtrim(number_format($order->quantity, 2, ',', '.'), '0'), ',') }}
                                    {{ $order->unit }}
                                </small>

                            </td>


                            {{-- TOTAL --}}
                            <td>

                                <span class="amount">
                                    Rp {{ number_format($order->total, 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- DIBAYAR --}}
                            <td>

                                <span class="amount">
                                    Rp {{ number_format($order->paid, 0, ',', '.') }}
                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @php
                                    $statusClass = match($order->status) {
                                        'Menunggu' => 'status-menunggu',
                                        'Diproses' => 'status-diproses',
                                        'Selesai' => 'status-selesai',
                                        'Dibatalkan' => 'status-dibatalkan',
                                        default => 'status-menunggu',
                                    };
                                @endphp

                                <span class="status-badge {{ $statusClass }}">
                                    {{ $order->status }}
                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-wrapper">

                                    {{-- DETAIL --}}
                                    <a href="{{ route('orders.show', $order) }}"
                                       class="btn btn-sm btn-outline-info"
                                       title="Detail">

                                        <i class="bi bi-eye"></i>

                                    </a>


                                    {{-- EDIT --}}
                                    <a href="{{ route('orders.edit', $order) }}"
                                       class="btn btn-sm btn-outline-warning"
                                       title="Edit">

                                        <i class="bi bi-pencil"></i>

                                    </a>


                                    {{-- HAPUS --}}
                                    <form action="{{ route('orders.destroy', $order) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Yakin ingin menghapus pesanan ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="btn btn-sm btn-outline-danger"
                                                title="Hapus">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8">

                                <div class="empty-order">

                                    <i class="bi bi-cart3"></i>

                                    <div class="fw-semibold mb-1">
                                        Belum ada pesanan
                                    </div>

                                    <small>
                                        Tambahkan pesanan pertama.
                                    </small>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if($orders->hasPages())

            <div class="p-3 border-top">

                {{ $orders->links() }}

            </div>

        @endif

    </div>

</div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');

            if (successAlert) {
                setTimeout(function() {
                    const alert = bootstrap.Alert.getOrCreateInstance(successAlert);
                    alert.close();
                }, 5000);
            }
        });
    </script>
@endpush