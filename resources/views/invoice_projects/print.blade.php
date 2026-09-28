<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <title>
        Invoice {{ $order->invoice_code }}
    </title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px;
            font-family: Arial, sans-serif;
            color: #222;
            background: #fff;
        }

        .invoice {
            max-width: 800px;
            margin: auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 35px;
        }

        .brand {
            font-size: 28px;
            font-weight: 700;
            color: #6257e8;
        }

        .invoice-title {
            text-align: right;
        }

        .invoice-title h1 {
            margin: 0;
            font-size: 28px;
        }

        .invoice-title p {
            margin: 5px 0;
            color: #666;
        }

        .line {
            border-top: 2px solid #6257e8;
            margin-bottom: 25px;
        }

        .customer {
            margin-bottom: 30px;
        }

        .label {
            font-size: 11px;
            color: #888;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .value {
            font-weight: 600;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th {
            background: #f5f5f8;
            text-align: left;
            padding: 12px;
            font-size: 12px;
        }

        td {
            padding: 14px 12px;
            border-bottom: 1px solid #eee;
            font-size: 13px;
        }

        .text-right {
            text-align: right;
        }

        .summary {
            width: 320px;
            margin-left: auto;
            margin-top: 25px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 7px 0;
        }

        .summary-total {
            border-top: 2px solid #222;
            margin-top: 5px;
            padding-top: 12px;
            font-size: 16px;
            font-weight: 700;
        }

        .notes {
            margin-top: 35px;
        }

        .footer {
            margin-top: 60px;
            text-align: center;
            font-size: 11px;
            color: #888;
        }

        .print-button {
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            background: #6257e8;
            color: white;
            cursor: pointer;
        }

        @media print {

            body {
                padding: 0;
            }

            .print-button {
                display: none;
            }

        }
    </style>

</head>

<body>

    @php
        $remaining = $order->total - $order->paid;
    @endphp

    <button class="print-button" onclick="window.print()">

        Cetak Invoice

    </button>


    <div class="invoice">

        <div class="header">

            <div>

                <div class="brand">
                    Gemiprint
                </div>

                <div>
                    Percetakan & Digital Printing
                </div>

            </div>


            <div class="invoice-title">

                <h1>INVOICE</h1>

                <p>
                    {{ $order->invoice_code }}
                </p>

                <p>
                    {{ $order->order_date->format('d/m/Y') }}
                </p>

            </div>

        </div>


        <div class="line"></div>


        <div class="customer">

            <div class="label">
                Ditagihkan Kepada
            </div>

            <div class="value">
                {{ $order->customer->name }}
            </div>

            @if ($order->customer->phone)
                <div>
                    {{ $order->customer->phone }}
                </div>
            @endif

            @if ($order->customer->address)
                <div>
                    {{ $order->customer->address }}
                </div>
            @endif

        </div>


        <table>

            <thead>

                <tr>

                    <th>
                        Nama Project
                    </th>

                    <th class="text-right">
                        Qty
                    </th>

                    <th class="text-right">
                        Harga
                    </th>

                    <th class="text-right">
                        Total
                    </th>

                </tr>

            </thead>

            <tbody>

                <tr>

                    <td>

                        <strong>
                            {{ $order->product->name }}
                        </strong>

                        @if ($order->specification)
                            <br>

                            <small>
                                {{ $order->specification }}
                            </small>
                        @endif

                    </td>

                    <td class="text-right">

                        {{ $order->quantity }}
                        {{ $order->unit }}

                    </td>

                    <td class="text-right">

                        Rp
                        {{ number_format($order->price, 0, ',', '.') }}

                    </td>

                    <td class="text-right">

                        Rp
                        {{ number_format($order->total, 0, ',', '.') }}

                    </td>

                </tr>

            </tbody>

        </table>


        <div class="summary">

            <div class="summary-row">

                <span>
                    Total
                </span>

                <strong>
                    Rp
                    {{ number_format($order->total, 0, ',', '.') }}
                </strong>

            </div>


            <div class="summary-row">

                <span>
                    Dibayar
                </span>

                <strong>
                    Rp
                    {{ number_format($order->paid, 0, ',', '.') }}
                </strong>

            </div>


            <div class="summary-row summary-total">

                <span>
                    Sisa Pembayaran
                </span>

                <strong>
                    Rp
                    {{ number_format(max($remaining, 0), 0, ',', '.') }}
                </strong>

            </div>

        </div>


        @if ($order->notes)
            <div class="notes">

                <div class="label">
                    Catatan
                </div>

                <div>
                    {{ $order->notes }}
                </div>

            </div>
        @endif


        <div class="footer">

            Terima kasih telah menggunakan layanan Gemiprint.

        </div>

    </div>

</body>

</html>
