@extends('layouts.app')

@section('title', 'Manajemen Piutang')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>

            <h4 class="fw-bold mb-1">
                Manajemen Piutang
            </h4>

            <p class="text-muted mb-0">
                Kelola tagihan pelanggan yang belum lunas.
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


    {{-- SUMMARY --}}
    <div class="row g-3 mb-4">

        {{-- TOTAL PIUTANG --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="text-muted small mb-1">
                                TOTAL PIUTANG
                            </div>

                            <h4 class="fw-bold mb-0">

                                Rp
                                {{ number_format(
                                    $totalReceivable,
                                    0,
                                    ',',
                                    '.'
                                ) }}

                            </h4>

                        </div>

                        <div class="rounded-circle bg-danger-subtle p-3">

                            <i class="bi bi-wallet2 text-danger fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL INVOICE --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="text-muted small mb-1">
                                INVOICE BELUM LUNAS
                            </div>

                            <h4 class="fw-bold mb-0">
                                {{ $totalInvoices }}
                            </h4>

                        </div>

                        <div class="rounded-circle bg-warning-subtle p-3">

                            <i class="bi bi-receipt text-warning fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- TOTAL PELANGGAN --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm h-100">

                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center">

                        <div>

                            <div class="text-muted small mb-1">
                                PELANGGAN MEMILIKI PIUTANG
                            </div>

                            <h4 class="fw-bold mb-0">
                                {{ $totalCustomers }}
                            </h4>

                        </div>

                        <div class="rounded-circle bg-primary-subtle p-3">

                            <i class="bi bi-people text-primary fs-5"></i>

                        </div>

                    </div>

                </div>

            </div>

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
                                Kode Invoice
                            </th>

                            <th>
                                Tanggal
                            </th>

                            <th>
                                Pelanggan
                            </th>

                            <th>
                                Total
                            </th>

                            <th>
                                Dibayar
                            </th>

                            <th>
                                Sisa Piutang
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

                        @forelse($receivables as $order)

                            @php
                                $remaining =
                                    $order->total -
                                    $order->paid;

                                if ($order->paid > 0) {
                                    $paymentStatus = 'DP';
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

                                    <div class="fw-semibold">
                                        {{ $order->customer->name }}
                                    </div>

                                    @if($order->customer->phone)

                                        <small class="text-muted">
                                            {{ $order->customer->phone }}
                                        </small>

                                    @endif

                                </td>


                                {{-- TOTAL --}}
                                <td>

                                    Rp
                                    {{ number_format(
                                        $order->total,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                {{-- PAID --}}
                                <td>

                                    Rp
                                    {{ number_format(
                                        $order->paid,
                                        0,
                                        ',',
                                        '.'
                                    ) }}

                                </td>


                                {{-- REMAINING --}}
                                <td>

                                    <span class="fw-bold text-danger">

                                        Rp
                                        {{ number_format(
                                            $remaining,
                                            0,
                                            ',',
                                            '.'
                                        ) }}

                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($paymentStatus === 'DP')

                                        <span class="badge rounded-pill bg-warning-subtle text-warning">
                                            DP
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
                                            'receivables.show',
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
                                           title="Cetak Invoice">

                                            <i class="bi bi-printer"></i>

                                        </a>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="8"
                                    class="text-center py-5">

                                    <i class="bi bi-check-circle fs-1 text-success"></i>

                                    <div class="fw-semibold mt-3">
                                        Tidak ada piutang
                                    </div>

                                    <small class="text-muted">
                                        Semua transaksi pelanggan sudah lunas.
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

        {{ $receivables->links() }}

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