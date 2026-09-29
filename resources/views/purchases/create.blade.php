@extends('layouts.app')

@section('title', 'Tambah Pembelian')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Tambah Pembelian
        </h4>

        <p class="text-muted mb-0">
            Tambahkan transaksi pembelian dari supplier.
        </p>

    </div>


    <form action="{{ route('purchases.store') }}"
          method="POST">

        @csrf


        <div class="row g-4">

            <div class="col-lg-8">

                <div class="card border-0 shadow-sm">

                    <div class="card-body p-4">

                        <div class="row g-3">

                            {{-- KODE --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Kode Pembelian
                                </label>

                                <input type="text"
                                       name="purchase_code"
                                       class="form-control @error('purchase_code') is-invalid @enderror"
                                       value="{{ old(
                                           'purchase_code',
                                           'PB-' . str_pad(
                                               (string) (
                                                   \App\Models\Purchase::count() + 1
                                               ),
                                               3,
                                               '0',
                                               STR_PAD_LEFT
                                           )
                                       ) }}">

                                @error('purchase_code')
                                    <div class="invalid-feedback">
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
                                       class="form-control @error('purchase_date') is-invalid @enderror"
                                       value="{{ old(
                                           'purchase_date',
                                           now()->format('Y-m-d\TH:i')
                                       ) }}">

                                @error('purchase_date')
                                    <div class="invalid-feedback">
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
                                        class="form-select @error('supplier_id') is-invalid @enderror">

                                    <option value="">
                                        -- Pilih Supplier --
                                    </option>

                                    @foreach($suppliers as $supplier)

                                        <option value="{{ $supplier->id }}"
                                            {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>

                                            {{ $supplier->name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('supplier_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- PRODUCT --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Produk
                                </label>

                                <select name="product_id"
                                        id="product_id"
                                        class="form-select @error('product_id') is-invalid @enderror">

                                    <option value="">
                                        -- Pilih Produk --
                                    </option>

                                    @foreach($products as $product)

                                        <option value="{{ $product->id }}"
                                                data-unit="{{ $product->unit }}"
                                                data-price="{{ $product->purchase_price }}"
                                            {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                            {{ $product->name }}

                                        </option>

                                    @endforeach

                                </select>

                                @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- QUANTITY --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Jumlah
                                </label>

                                <input type="number"
                                       name="quantity"
                                       id="quantity"
                                       class="form-control @error('quantity') is-invalid @enderror"
                                       min="0.01"
                                       step="0.01"
                                       value="{{ old('quantity', 1) }}">

                                @error('quantity')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- UNIT --}}
                            <div class="col-md-4">

                                <label class="form-label fw-semibold">
                                    Satuan
                                </label>

                                <input type="text"
                                       name="unit"
                                       id="unit"
                                       class="form-control @error('unit') is-invalid @enderror"
                                       value="{{ old('unit') }}"
                                       placeholder="pcs">

                                @error('unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

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
                                           class="form-control @error('price') is-invalid @enderror"
                                           min="0"
                                           step="0.01"
                                           value="{{ old('price', 0) }}">

                                </div>

                                @error('price')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

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
                                           class="form-control @error('paid') is-invalid @enderror"
                                           min="0"
                                           step="0.01"
                                           value="{{ old('paid', 0) }}">

                                </div>

                                @error('paid')
                                    <div class="text-danger small mt-1">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>


                            {{-- STATUS --}}
                            <div class="col-md-6">

                                <label class="form-label fw-semibold">
                                    Status Pembayaran
                                </label>

                                <select name="status"
                                        id="status"
                                        class="form-select">

                                    <option value="LUNAS"
                                        {{ old('status') === 'LUNAS' ? 'selected' : '' }}>
                                        LUNAS
                                    </option>

                                    <option value="BELUM LUNAS"
                                        {{ old('status') === 'BELUM LUNAS' ? 'selected' : '' }}>
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
                                          rows="3"
                                          placeholder="Catatan pembelian (opsional)">{{ old('notes') }}</textarea>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- SUMMARY --}}
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
                                Simpan

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

    const product = document.getElementById('product_id');
    const quantity = document.getElementById('quantity');
    const unit = document.getElementById('unit');
    const price = document.getElementById('price');
    const paid = document.getElementById('paid');

    const totalDisplay =
        document.getElementById('total_display');

    const summaryTotal =
        document.getElementById('summary_total');

    const summaryPaid =
        document.getElementById('summary_paid');

    const summaryRemaining =
        document.getElementById('summary_remaining');


    function formatRupiah(value) {

        return 'Rp ' +
            Number(value || 0).toLocaleString(
                'id-ID'
            );

    }


    function calculate() {

        const qty =
            parseFloat(quantity.value) || 0;

        const priceValue =
            parseFloat(price.value) || 0;

        const paidValue =
            parseFloat(paid.value) || 0;

        const total =
            qty * priceValue;

        const remaining =
            Math.max(total - paidValue, 0);


        totalDisplay.textContent =
            formatRupiah(total);

        summaryTotal.textContent =
            formatRupiah(total);

        summaryPaid.textContent =
            formatRupiah(paidValue);

        summaryRemaining.textContent =
            formatRupiah(remaining);

    }


    product.addEventListener('change', function () {

        const selected =
            this.options[this.selectedIndex];

        if (!selected) {
            return;
        }

        unit.value =
            selected.dataset.unit || '';

        price.value =
            selected.dataset.price || 0;

        calculate();

    });


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