@extends('layouts.app')

@section('title', 'Edit Pembelian')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Edit Pembelian
        </h4>

        <p class="text-muted mb-0">
            Perbarui transaksi pembelian.
        </p>

    </div>


    <form action="{{ route(
        'purchases.update',
        $purchase
    ) }}"
          method="POST">

        @csrf

        @method('PUT')


        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <div class="row g-3">

                            {{-- CODE --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Kode Pembelian
                                </label>

                                <input type="text"
                                       name="purchase_code"
                                       class="form-control"
                                       value="{{ old(
                                           'purchase_code',
                                           $purchase->purchase_code
                                       ) }}">

                                @error('purchase_code')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- DATE --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Tanggal Pembelian
                                </label>

                                <input type="datetime-local"
                                       name="purchase_date"
                                       class="form-control"
                                       value="{{ old(
                                           'purchase_date',
                                           $purchase->purchase_date->format('Y-m-d\TH:i')
                                       ) }}">

                                @error('purchase_date')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- SUPPLIER --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Supplier
                                </label>

                                <select name="supplier_id"
                                        class="form-select">

                                    @foreach($suppliers as $supplier)

                                        <option value="{{ $supplier->id }}"
                                            {{ old(
                                                'supplier_id',
                                                $purchase->supplier_id
                                            ) == $supplier->id
                                                ? 'selected'
                                                : ''
                                            }}>

                                            {{ $supplier->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- PRODUCT --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Produk
                                </label>

                                <select name="product_id"
                                        id="product_id"
                                        class="form-select">

                                    @foreach($products as $product)

                                        <option value="{{ $product->id }}"
                                                data-unit="{{ $product->unit }}"
                                                data-price="{{ $product->purchase_price }}"
                                            {{ old(
                                                'product_id',
                                                $purchase->product_id
                                            ) == $product->id
                                                ? 'selected'
                                                : ''
                                            }}>

                                            {{ $product->name }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- QUANTITY --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Jumlah
                                </label>

                                <input type="number"
                                       name="quantity"
                                       id="quantity"
                                       class="form-control"
                                       min="0.01"
                                       step="0.01"
                                       value="{{ old(
                                           'quantity',
                                           $purchase->quantity
                                       ) }}">

                            </div>


                            {{-- UNIT --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Satuan
                                </label>

                                <input type="text"
                                       name="unit"
                                       id="unit"
                                       class="form-control"
                                       value="{{ old(
                                           'unit',
                                           $purchase->unit
                                       ) }}">

                            </div>


                            {{-- PRICE --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Harga Beli
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input type="number"
                                           name="price"
                                           id="price"
                                           class="form-control"
                                           min="0"
                                           step="0.01"
                                           value="{{ old(
                                               'price',
                                               $purchase->price
                                           ) }}">

                                </div>

                            </div>


                            {{-- TOTAL --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Total Pembelian
                                </label>

                                <div class="form-control bg-light fw-bold"
                                     id="total_display">
                                    Rp 0
                                </div>

                            </div>


                            {{-- PAID --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Dibayar
                                </label>

                                <div class="input-group">

                                    <span class="input-group-text">
                                        Rp
                                    </span>

                                    <input type="number"
                                           name="paid"
                                           id="paid"
                                           class="form-control"
                                           min="0"
                                           step="0.01"
                                           value="{{ old(
                                               'paid',
                                               $purchase->paid
                                           ) }}">

                                </div>

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Status Pembayaran
                                </label>

                                <select name="status"
                                        class="form-select">

                                    <option value="LUNAS"
                                        {{ old(
                                            'status',
                                            $purchase->status
                                        ) === 'LUNAS'
                                            ? 'selected'
                                            : ''
                                        }}>
                                        LUNAS
                                    </option>

                                    <option value="BELUM LUNAS"
                                        {{ old(
                                            'status',
                                            $purchase->status
                                        ) === 'BELUM LUNAS'
                                            ? 'selected'
                                            : ''
                                        }}>
                                        BELUM LUNAS
                                    </option>

                                </select>

                            </div>


                            {{-- NOTES --}}
                            <div class="col-12">

                                <label class="form-label fw-semibold">
                                    Catatan
                                </label>

                                <textarea name="notes"
                                          class="form-control"
                                          rows="3">{{ old(
                                              'notes',
                                              $purchase->notes
                                          ) }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            <div class="col-lg-4">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <h6 class="fw-bold mb-4">
                            Ringkasan Pembelian
                        </h6>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Total
                            </span>

                            <strong id="summary_total">
                                Rp 0
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between mb-3">

                            <span class="text-muted">
                                Dibayar
                            </span>

                            <strong id="summary_paid">
                                Rp 0
                            </strong>

                        </div>

                        <div class="d-flex justify-content-between border-top pt-3">

                            <span class="fw-semibold">
                                Sisa Hutang
                            </span>

                            <strong class="text-danger"
                                    id="summary_remaining">
                                Rp 0
                            </strong>

                        </div>

                        <hr class="my-4">

                        <div class="d-flex gap-2">

                            <a href="{{ route('purchases.index') }}"
                                class="btn btn-light border w-50">

                                <i class="bi bi-arrow-left me-1"></i>
                                Kembali

                            </a>

                            <button type="submit"
                                    class="btn btn-primary w-50">

                                <i class="bi bi-save me-1"></i>
                                Update

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </form>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const quantity =
        document.getElementById('quantity');

    const price =
        document.getElementById('price');

    const paid =
        document.getElementById('paid');

    const totalDisplay =
        document.getElementById('total_display');

    const summaryTotal =
        document.getElementById('summary_total');

    const summaryPaid =
        document.getElementById('summary_paid');

    const summaryRemaining =
        document.getElementById('summary_remaining');


    function rupiah(value) {

        return 'Rp ' +
            Number(value || 0).toLocaleString(
                'id-ID'
            );

    }


    function calculate() {

        const total =
            (parseFloat(quantity.value) || 0) *
            (parseFloat(price.value) || 0);

        const paidValue =
            parseFloat(paid.value) || 0;

        const remaining =
            Math.max(
                total - paidValue,
                0
            );

        totalDisplay.textContent =
            rupiah(total);

        summaryTotal.textContent =
            rupiah(total);

        summaryPaid.textContent =
            rupiah(paidValue);

        summaryRemaining.textContent =
            rupiah(remaining);

    }


    quantity.addEventListener(
        'input',
        calculate
    );

    price.addEventListener(
        'input',
        calculate
    );

    paid.addEventListener(
        'input',
        calculate
    );


    calculate();

});

</script>

@endsection