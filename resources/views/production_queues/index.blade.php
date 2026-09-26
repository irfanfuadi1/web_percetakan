@extends('layouts.app')

@section('title', 'Antrian Produksi')

@section('content')

<style>
    .production-header {
        margin-bottom: 25px;
    }

    .production-header h4 {
        font-weight: 700;
        margin-bottom: 5px;
    }

    .production-header p {
        color: #8b8b98;
        margin-bottom: 0;
        font-size: 13px;
    }

    .queue-count {
        background: #6257e8;
        color: #fff;
        border-radius: 8px;
        padding: 8px 14px;
        font-size: 12px;
        font-weight: 600;
    }

    .production-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
    }

    .production-card {
        background: #fff;
        border: 1px solid #eeeeF4;
        border-radius: 10px;
        padding: 18px;
        transition: all .2s ease;
    }

    .production-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, .06);
    }

    .invoice-code {
        font-size: 14px;
        font-weight: 700;
        color: #30303b;
    }

    .invoice-date {
        font-size: 11px;
        color: #999;
        margin-top: 2px;
    }

    .payment-badge {
        font-size: 9px;
        font-weight: 700;
        padding: 5px 8px;
        border-radius: 20px;
    }

    .payment-paid {
        background: #dff8ec;
        color: #15945d;
    }

    .payment-unpaid {
        background: #fff0f0;
        color: #dc3545;
    }

    .customer-name {
        margin-top: 20px;
        font-size: 15px;
        font-weight: 600;
        color: #333;
    }

    .production-divider {
        border-top: 1px solid #f0f0f3;
        margin: 15px 0;
    }

    .info-label {
        font-size: 9px;
        font-weight: 700;
        color: #999;
        text-transform: uppercase;
        margin-bottom: 3px;
    }

    .info-value {
        font-size: 12px;
        color: #333;
        font-weight: 500;
    }

    .file-value {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .file-icon {
        color: #6257e8;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 18px;
        margin-bottom: 7px;
    }

    .progress-label span:first-child {
        font-size: 10px;
        color: #999;
    }

    .progress-label span:last-child {
        font-size: 10px;
        font-weight: 700;
        color: #6257e8;
    }

    .production-progress {
        height: 5px;
        background: #eeeeF4;
        border-radius: 10px;
        overflow: hidden;
    }

    .production-progress .progress-bar {
        background: #6257e8;
        border-radius: 10px;
    }

    .status-row {
        margin-top: 10px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .status-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #f0ad00;
    }

    .status-dot.selesai {
        background: #20b26b;
    }

    .status-dot.diproses {
        background: #6257e8;
    }

    .status-dot.menunggu {
        background: #f0ad00;
    }

    .production-status {
        font-size: 10px;
        color: #777;
    }

    .production-actions {
        margin-top: 17px;
        display: flex;
        flex-direction: column;
        gap: 7px;
    }

    .production-actions .btn {
        width: 100%;
        font-size: 11px;
        border-radius: 7px;
        padding: 7px 10px;
    }

    .empty-production {
        grid-column: 1 / -1;
        text-align: center;
        padding: 70px 20px;
        background: #fff;
        border: 1px solid #eeeef4;
        border-radius: 10px;
        color: #999;
    }

    .empty-production i {
        font-size: 40px;
        margin-bottom: 12px;
        color: #c7c7d0;
    }

    @media (max-width: 1200px) {
        .production-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 768px) {
        .production-grid {
            grid-template-columns: 1fr;
        }
    }
</style>


<div class="container-fluid">

    {{-- HEADER --}}
    <div class="production-header d-flex justify-content-between align-items-center">

        <div>
            <h4>
                Antrian Produksi
            </h4>

            <p>
                Halo, Admin! Semangat kerjanya.
            </p>
        </div>

        <span class="queue-count">
            {{ $totalQueues }} Antrian
        </span>

    </div>


    {{-- SUCCESS --}}
    @if(session('success'))

        <div class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- ERROR --}}
    @if(session('error'))

        <div class="alert alert-danger alert-dismissible fade show"
             role="alert">

            <i class="bi bi-exclamation-circle me-2"></i>

            {{ session('error') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>

        </div>

    @endif


    {{-- PRODUCTION GRID --}}
    <div class="production-grid">

        @forelse($productionQueues as $queue)

            <div class="production-card">

                {{-- HEADER CARD --}}
                <div class="d-flex justify-content-between align-items-start">

                    <div>

                        <div class="invoice-code">
                            #{{ $queue->invoice_code }}
                        </div>

                        <div class="invoice-date">
                            {{ $queue->invoice_date->format('d/m H:i') }}
                        </div>

                    </div>


                    {{-- PAYMENT STATUS --}}
                    @if($queue->payment_status === 'LUNAS')

                        <span class="payment-badge payment-paid">
                            LUNAS
                        </span>

                    @else

                        <span class="payment-badge payment-unpaid">
                            BELUM LUNAS
                        </span>

                    @endif

                </div>


                {{-- CUSTOMER --}}
                <div class="customer-name">
                    {{ $queue->customer_name }}
                </div>


                <div class="production-divider"></div>


                {{-- ITEM --}}
                <div class="mb-3">

                    <div class="info-label">
                        Item
                    </div>

                    <div class="info-value">
                        {{ $queue->item }}
                    </div>

                </div>


                {{-- FILE / SPECIFICATION --}}
                <div>

                    <div class="info-label">
                        File
                    </div>

                    <div class="info-value file-value">

                        {{ $queue->specification }}

                        @if($queue->file_path)

                            <i class="bi bi-file-earmark file-icon"></i>

                        @endif

                    </div>

                </div>


                {{-- PROGRESS --}}
                <div class="progress-label">

                    <span>
                        Progress
                    </span>

                    <span>
                        {{ $queue->progress }}%
                    </span>

                </div>

                <div class="production-progress">

                    <div class="progress-bar"
                         role="progressbar"
                         style="width: {{ $queue->progress }}%;"
                         aria-valuenow="{{ $queue->progress }}"
                         aria-valuemin="0"
                         aria-valuemax="100">
                    </div>

                </div>


                {{-- STATUS PRODUKSI --}}
                <div class="status-row">

                    <span class="status-dot {{ strtolower($queue->production_status) }}">
                    </span>

                    <span class="production-status">
                        {{ $queue->production_status }}
                    </span>

                </div>


                {{-- ACTION --}}
                <div class="production-actions">

                    @if($queue->production_status !== 'Selesai')

                        <form action="{{ route('production-queues.complete', $queue) }}"
                              method="POST">

                            @csrf
                            @method('PATCH')

                            <button type="submit"
                                    class="btn btn-outline-primary">

                                <i class="bi bi-check-circle"></i>

                                Tandai Selesai

                            </button>

                        </form>

                    @else

                        <button type="button"
                                class="btn btn-outline-success"
                                disabled>

                            <i class="bi bi-check-circle-fill"></i>

                            Produksi Selesai

                        </button>

                    @endif


                    {{-- DOWNLOAD --}}
                    @if($queue->file_path)

                        <a href="{{ route('production-queues.download', $queue) }}"
                           class="btn btn-outline-secondary">

                            <i class="bi bi-download"></i>

                            Download File

                        </a>

                    @else

                        <button type="button"
                                class="btn btn-outline-secondary"
                                disabled>

                            <i class="bi bi-download"></i>

                            File Tidak Tersedia

                        </button>

                    @endif

                </div>

            </div>

        @empty

            <div class="empty-production">

                <i class="bi bi-scissors d-block"></i>

                <div class="fw-semibold mb-1">
                    Belum ada antrian produksi
                </div>

                <small>
                    Pesanan yang membutuhkan produksi akan muncul di sini.
                </small>

            </div>

        @endforelse

    </div>

</div>

@endsection