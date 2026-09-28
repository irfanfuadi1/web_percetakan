@extends('layouts.app')

@section('title', 'Edit Pesanan')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Edit Pesanan
        </h4>

        <p class="text-muted mb-0">
            Perbarui data pesanan pelanggan.
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('orders.update', $order) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="row">

                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Kode Invoice
                        </label>

                        <input type="text"
                               name="invoice_code"
                               class="form-control"
                               value="{{ old('invoice_code', $order->invoice_code) }}">

                        @error('invoice_code')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Tanggal
                        </label>

                        <input type="datetime-local"
                               name="order_date"
                               class="form-control"
                               value="{{ old('order_date', $order->order_date->format('Y-m-d\TH:i')) }}">

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Pelanggan
                        </label>

                        <select name="customer_id"
                                class="form-select">

                            @foreach($customers as $customer)

                                <option value="{{ $customer->id }}"
                                    {{ old('customer_id', $order->customer_id) == $customer->id ? 'selected' : '' }}>

                                    {{ $customer->code }}
                                    -
                                    {{ $customer->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Produk
                        </label>

                        <select name="product_id"
                                id="product_id"
                                class="form-select">

                            @foreach($products as $product)

                                <option value="{{ $product->id }}"
                                        data-price="{{ $product->selling_price }}"
                                        data-unit="{{ $product->unit }}"
                                    {{ old('product_id', $order->product_id) == $product->id ? 'selected' : '' }}>

                                    {{ $product->code }}
                                    -
                                    {{ $product->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Jumlah
                        </label>

                        <input type="number"
                               name="quantity"
                               id="quantity"
                               class="form-control"
                               value="{{ old('quantity', $order->quantity) }}"
                               min="0.01"
                               step="0.01">

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Satuan
                        </label>

                        <input type="text"
                               name="unit"
                               id="unit"
                               class="form-control"
                               value="{{ old('unit', $order->unit) }}">

                    </div>


                    <div class="col-md-4 mb-3">

                        <label class="form-label">
                            Harga
                        </label>

                        <input type="number"
                               name="price"
                               id="price"
                               class="form-control"
                               value="{{ old('price', $order->price) }}"
                               min="0"
                               step="0.01">

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Total
                        </label>

                        <input type="text"
                               id="total_display"
                               class="form-control"
                               value="Rp {{ number_format($order->total, 0, ',', '.') }}"
                               readonly>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Dibayar
                        </label>

                        <input type="number"
                               name="paid"
                               class="form-control"
                               value="{{ old('paid', $order->paid) }}"
                               min="0"
                               step="0.01">

                        @error('paid')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="status"
                                class="form-select">

                            @foreach([
                                'Menunggu',
                                'Diproses',
                                'Selesai',
                                'Dibatalkan'
                            ] as $status)

                                <option value="{{ $status }}"
                                    {{ old('status', $order->status) === $status ? 'selected' : '' }}>

                                    {{ $status }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Spesifikasi
                        </label>

                        <input type="text"
                               name="specification"
                               class="form-control"
                               value="{{ old('specification', $order->specification) }}">

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Ganti File Desain
                        </label>

                        <input type="file"
                               name="file"
                               class="form-control">

                        <div class="form-text">
                            Kosongkan jika tidak ingin mengganti file.
                        </div>

                    </div>


                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea name="notes"
                                  class="form-control"
                                  rows="3">{{ old('notes', $order->notes) }}</textarea>

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
                        Update

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

        totalDisplay.value =
            formatRupiah(qty * harga);
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