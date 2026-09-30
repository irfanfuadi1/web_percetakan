@extends('layouts.app')

@section('title', 'Laporan Laba Rugi')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-start mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Laporan Laba Rugi (Profit & Loss)
                </h4>

                <p class="text-muted mb-0">
                    Analisis pendapatan, biaya, dan keuntungan bersih.
                </p>

            </div>


            <button type="button" class="btn btn-light border" onclick="window.print()">

                <i class="bi bi-printer me-1"></i>

                Cetak

            </button>

        </div>


        {{-- ALERT --}}
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">

                <i class="bi bi-exclamation-circle me-2"></i>

                {{ session('error') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif


        {{-- FILTER --}}
        <div class="card border-0 shadow-sm mb-4">

            <div class="card-body">

                <form action="{{ route('reports.profit-loss.index') }}" method="GET">

                    <div class="row g-3 align-items-end">


                        {{-- DARI TANGGAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Dari Tanggal
                            </label>

                            <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}"
                                required>

                        </div>


                        {{-- SAMPAI TANGGAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Sampai Tanggal
                            </label>

                            <input type="date" name="to_date" class="form-control" value="{{ $toDate }}" required>

                        </div>


                        {{-- FILTER --}}
                        <div class="col-md-4">

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>


                            <a href="{{ route('reports.profit-loss.index') }}" class="btn btn-light border ms-1">

                                <i class="bi bi-arrow-clockwise me-1"></i>

                                Reset

                            </a>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- LAPORAN --}}
        <div class="profit-loss-wrapper">

            {{-- PERIODE --}}
            <div class="profit-period">

                Periode:

                {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }}

                -

                {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}

            </div>


            <div class="profit-loss-body">


                {{-- =========================================================
                     PENDAPATAN
                     ========================================================= --}}

                <div class="section-row">

                    <div>

                        <h5 class="section-title">
                            Pendapatan Penjualan (Revenue)
                        </h5>

                    </div>

                    <div class="fw-bold text-success">
                        Included
                    </div>

                </div>


                <div class="detail-row">

                    <span>
                        Total Penjualan Kotor
                    </span>

                    <span class="fw-semibold">

                        Rp
                        {{ number_format($totalRevenue, 0, ',', '.') }}

                    </span>

                </div>


                {{-- =========================================================
                     HPP
                     ========================================================= --}}

                <div class="section-row mt-3">

                    <h5 class="section-title">
                        Harga Pokok Penjualan (HPP)
                    </h5>

                    <span class="fw-bold text-danger">
                        (-)
                    </span>

                </div>


                <div class="detail-row">

                    <span>
                        Total HPP Barang Terjual
                    </span>

                    <span class="fw-semibold text-danger">

                        Rp
                        {{ number_format($totalHpp, 0, ',', '.') }}

                    </span>

                </div>


                {{-- =========================================================
                     LABA KOTOR
                     ========================================================= --}}

                <div class="gross-profit-row">

                    <span>
                        Laba Kotor (Gross Profit)
                    </span>

                    <span>

                        Rp
                        {{ number_format($grossProfit, 0, ',', '.') }}

                    </span>

                </div>


                {{-- =========================================================
                     BIAYA OPERASIONAL
                     ========================================================= --}}

                <div class="section-row mt-3">

                    <h5 class="section-title">
                        Biaya Operasional
                    </h5>

                    <span class="fw-bold text-danger">
                        (-)
                    </span>

                </div>


                <div class="detail-row">

                    <div>

                        <span>
                            • Lainnya
                        </span>

                    </div>

                    <span class="text-danger fw-semibold">

                        Rp
                        {{ number_format($totalOperatingExpense, 0, ',', '.') }}

                    </span>

                </div>


                <div class="total-expense-row">

                    <span>
                        Total Biaya Operasional
                    </span>

                    <span>

                        Rp
                        {{ number_format($totalOperatingExpense, 0, ',', '.') }}

                    </span>

                </div>


                {{-- =========================================================
                     LABA BERSIH
                     ========================================================= --}}

                <div class="net-profit-row">

                    <span>
                        Laba Bersih (Net Profit)
                    </span>

                    <span>

                        Rp
                        {{ number_format($netProfit, 0, ',', '.') }}

                    </span>

                </div>


                {{-- JUMLAH TRANSAKSI --}}
                <div class="transaction-info">

                    <i class="bi bi-receipt me-1"></i>

                    {{ number_format($totalTransactions, 0, ',', '.') }}
                    transaksi penjualan pada periode ini.

                </div>


            </div>

        </div>

    </div>


    {{-- STYLE --}}
    <style>
        .profit-loss-wrapper {
            max-width: 820px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .profit-period {
            background: #6257e8;
            color: #ffffff;
            text-align: center;
            font-size: 20px;
            font-weight: 600;
            padding: 12px 20px;
        }

        .profit-loss-body {
            padding: 20px 28px 28px;
        }

        .section-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eeeeee;
        }

        .section-title {
            margin: 0;
            font-size: 18px;
            font-weight: 600;
            color: #6c757d;
        }

        .detail-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 12px 10px;
            color: #495057;
        }

        .gross-profit-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 8px;
            padding: 12px 10px;
            background: #f8f9fa;
            border-radius: 8px;
            font-size: 20px;
            font-weight: 600;
        }

        .gross-profit-row span:last-child {
            color: #6257e8;
        }

        .total-expense-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 10px;
            border-top: 1px solid #eeeeee;
            font-weight: 700;
        }

        .total-expense-row span:last-child {
            color: #dc3545;
        }

        .net-profit-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 16px;
            padding: 16px 18px;
            background: #10b981;
            color: #ffffff;
            border-radius: 10px;
            font-size: 21px;
            font-weight: 700;
        }

        .transaction-info {
            margin-top: 15px;
            text-align: right;
            color: #6c757d;
            font-size: 13px;
        }


        @media (max-width: 768px) {

            .profit-loss-body {
                padding: 16px;
            }

            .profit-period {
                font-size: 16px;
            }

            .section-row,
            .detail-row,
            .gross-profit-row,
            .total-expense-row,
            .net-profit-row {
                gap: 10px;
            }

            .gross-profit-row,
            .net-profit-row {
                font-size: 17px;
            }

        }


        @media print {

            body {
                background: #ffffff !important;
            }

            .sidebar,
            .navbar,
            .btn,
            form,
            .transaction-info {
                display: none !important;
            }

            .container-fluid {
                width: 100% !important;
                max-width: 100% !important;
            }

            .profit-loss-wrapper {
                max-width: 100% !important;
                box-shadow: none !important;
                border: 1px solid #dddddd;
            }

        }
    </style>

@endsection
