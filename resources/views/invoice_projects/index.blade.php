@extends('layouts.app')

@section('title', 'Invoice Project')

@section('content')

<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">
                Invoice Project
            </h4>

            <p class="text-muted mb-0">
                Kelola dan cetak invoice dari pesanan pelanggan.
            </p>
        </div>
    </div>

    {{-- SUCCESS --}}
    @if(session('success'))

        <div id="successAlert" class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    <div class="card border-0 shadow-sm">

        <div class="card-body p-0">

            <div class="table-responsive">

                <table class="table align-middle mb-0">

                    <thead>
                        <tr>

                            <th class="px-4">
                                No. Invoice
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Pelanggan
                            </th>

                            <th>
                                Nama Project
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

                            @php
                                $remaining =
                                    $order->total - $order->paid;

                                if ($order->paid >= $order->total) {
                                    $paymentStatus = 'LUNAS';
                                } elseif ($order->paid > 0) {
                                    $paymentStatus = 'SEBAGIAN';
                                } else {
                                    $paymentStatus = 'BELUM LUNAS';
                                }
                            @endphp

                            <tr>

                                {{-- INVOICE --}}
                                <td class="px-4">

                                    <div class="fw-semibold">
                                        {{ $order->invoice_code }}
                                    </div>

                                </td>


                                {{-- DATE --}}
                                <td>

                                    <div>
                                        {{ $order->order_date->format('d/m/Y') }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $order->order_date->format('H:i') }}
                                    </small>

                                </td>


                                {{-- CUSTOMER --}}
                                <td>

                                    {{ $order->customer->name }}

                                </td>


                                {{-- PRODUCT --}}
                                <td>

                                    <div class="fw-semibold">
                                        {{ $order->product->name }}
                                    </div>

                                    <small class="text-muted">
                                        {{ $order->quantity }}
                                        {{ $order->unit }}
                                    </small>

                                </td>


                                {{-- TOTAL --}}
                                <td>

                                    <span class="fw-semibold">
                                        Rp
                                        {{ number_format(
                                            $order->total,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- PAID --}}
                                <td>

                                    <span class="fw-semibold">
                                        Rp
                                        {{ number_format(
                                            $order->paid,
                                            0,
                                            ',',
                                            '.'
                                        ) }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($paymentStatus === 'LUNAS')

                                        <span class="badge rounded-pill bg-success-subtle text-success">
                                            LUNAS
                                        </span>

                                    @elseif($paymentStatus === 'SEBAGIAN')

                                        <span class="badge rounded-pill bg-warning-subtle text-warning">
                                            SEBAGIAN
                                        </span>

                                    @else

                                        <span class="badge rounded-pill bg-danger-subtle text-danger">
                                            BELUM LUNAS
                                        </span>

                                    @endif

                                </td>


                                {{-- ACTION --}}
                                <td>

                                    <div class="d-flex gap-2">

                                        <a href="{{ route(
                                            'invoice-project.show',
                                            $order
                                        ) }}"
                                           class="btn btn-sm btn-outline-info"
                                           title="Detail">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        <a href="{{ route(
                                            'invoice-project.print',
                                            $order
                                        ) }}"
                                           target="_blank"
                                           class="btn btn-sm btn-outline-success"
                                           title="Cetak">

                                            <i class="bi bi-printer me-1"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center py-5">

                                    <i class="bi bi-receipt fs-1 text-muted"></i>

                                    <div class="fw-semibold mt-3">
                                        Belum ada invoice project
                                    </div>

                                    <small class="text-muted">
                                        Invoice akan muncul berdasarkan pesanan yang dibuat.
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

        {{ $orders->links() }}

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