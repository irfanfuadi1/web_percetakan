@extends('layouts.app')

@section('title', 'Tambah Pesanan')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Tambah Pesanan
        </h4>

        <p class="text-muted mb-0">
            Buat pesanan baru pelanggan.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('orders.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                <div class="row">

                    {{-- KODE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Kode Invoice
                        </label>

                        <input type="text"
                               name="invoice_code"
                               class="form-control @error('invoice_code') is-invalid @enderror"
                               value="{{ old('invoice_code') }}"
                               placeholder="Contoh: INV-001">

                        @error('invoice_code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TANGGAL --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input type="datetime-local"
                               name="order_date"
                               class="form-control @error('order_date') is-invalid @enderror"
                               value="{{ old('order_date', now()->format('Y-m-d\TH:i')) }}">

                        @error('order_date')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PELANGGAN --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Pelanggan
                        </label>

                        <select name="customer_id"
                                class="form-select @error('customer_id') is-invalid @enderror">

                            <option value="">
                                Pilih Pelanggan
                            </option>

                            @foreach($customers as $customer)

                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id') == $customer->id ? 'selected' : '' }}>

                                    {{ $customer->code }}
                                    - 
                                    {{ $customer->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('customer_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- PRODUK --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Produk
                        </label>

                        <select name="product_id"
                                id="product_id"
                                class="form-select @error('product_id') is-invalid @enderror">

                            <option value="">
                                Pilih Produk
                            </option>

                            @foreach($products as $product)

                                <option value="{{ $product->id }}"
                                        data-price="{{ $product->selling_price }}"
                                        data-unit="{{ $product->unit }}"
                                    {{ old('product_id') == $product->id ? 'selected' : '' }}>

                                    {{ $product->code }}
                                    -
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


                    {{-- JUMLAH --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Jumlah
                        </label>

                        <input type="number"
                               name="quantity"
                               id="quantity"
                               class="form-control @error('quantity') is-invalid @enderror"
                               value="{{ old('quantity', 1) }}"
                               min="0.01"
                               step="0.01">

                        @error('quantity')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SATUAN --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
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


                    {{-- HARGA --}}
                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <input type="number"
                               name="price"
                               id="price"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', 0) }}"
                               min="0"
                               step="0.01">

                        @error('price')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- TOTAL --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Total
                        </label>

                        <input type="text"
                               id="total_display"
                               class="form-control"
                               value="Rp 0"
                               readonly>

                    </div>


                    {{-- DIBAYAR --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Dibayar
                        </label>

                        <input type="number"
                               name="paid"
                               class="form-control @error('paid') is-invalid @enderror"
                               value="{{ old('paid', 0) }}"
                               min="0"
                               step="0.01">

                        @error('paid')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- STATUS --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select @error('status') is-invalid @enderror">

                            @foreach([
                                'Menunggu',
                                'Diproses',
                                'Selesai',
                                'Dibatalkan'
                            ] as $status)

                                <option value="{{ $status }}"
                                    {{ old('status', 'Menunggu') === $status ? 'selected' : '' }}>

                                    {{ $status }}

                                </option>

                            @endforeach

                        </select>

                        @error('status')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- SPESIFIKASI --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Spesifikasi
                        </label>

                        <input type="text"
                               name="specification"
                               class="form-control"
                               value="{{ old('specification') }}"
                               placeholder="Contoh: 2×1 meter">

                    </div>


                    {{-- FILE --}}
                    <div class="col-12 mb-3">

                        <label class="form-label">
                            File Desain
                        </label>

                        <input type="file"
                               name="file"
                               class="form-control">

                        <div class="form-text">
                            PDF, JPG, JPEG, PNG, WEBP — maksimal 10 MB.
                        </div>

                    </div>


                    {{-- CATATAN --}}
                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea name="notes"
                                  class="form-control"
                                  rows="3"
                                  placeholder="Catatan pesanan...">{{ old('notes') }}</textarea>

                    </div>

                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('orders.index') }}"
                       class="btn btn-light border">

                       <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>
                        Simpan Pesanan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>


<script>
document.addEventListener('DOMContentLoaded', function () {

    const product = document.getElementById('product_id');
    const quantity = document.getElementById('quantity');
    const price = document.getElementById('price');
    const unit = document.getElementById('unit');
    const totalDisplay = document.getElementById('total_display');

    function formatRupiah(value) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
    }

    function calculateTotal() {

        const qty = parseFloat(quantity.value) || 0;
        const harga = parseFloat(price.value) || 0;

        const total = qty * harga;

        totalDisplay.value = formatRupiah(total);
    }

    product.addEventListener('change', function () {

        const selected =
            this.options[this.selectedIndex];

        const selectedPrice =
            selected.getAttribute('data-price');

        const selectedUnit =
            selected.getAttribute('data-unit');

        if (selectedPrice !== null) {
            price.value = selectedPrice;
        }

        if (selectedUnit !== null) {
            unit.value = selectedUnit;
        }

        calculateTotal();
    });

    quantity.addEventListener(
        'input',
        calculateTotal
    );

    price.addEventListener(
        'input',
        calculateTotal
    );

    calculateTotal();

});
</script>

@endsection