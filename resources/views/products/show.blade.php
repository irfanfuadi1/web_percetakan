@extends('layouts.app')

@section('title', 'Detail Item')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Detail Item / Produk
            </h4>

            <p class="text-muted mb-0">
                Informasi item produk
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Kode
                        </label>

                        <h6 class="fw-bold">
                            {{ $product->code }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Nama Item
                        </label>

                        <h6 class="fw-bold">
                            {{ $product->name }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Supplier (Kategori)
                        </label>

                        <h6 class="fw-bold">
                            {{ $product->supplier_category }}
                        </h6>

                    </div>


                    <div class="col-md-3 mb-4">

                        <label class="text-muted">
                            Stok
                        </label>

                        <h6 class="fw-bold">
                            {{ $product->stock }}
                        </h6>

                    </div>


                    <div class="col-md-3 mb-4">

                        <label class="text-muted">
                            Satuan
                        </label>

                        <h6 class="fw-bold">
                            {{ $product->unit }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Harga Beli
                        </label>

                        <h6 class="fw-bold">
                            Rp {{ number_format($product->purchase_price, 0, ',', '.') }}
                        </h6>

                    </div>


                    <div class="col-md-6 mb-4">

                        <label class="text-muted">
                            Harga Jual
                        </label>

                        <h6 class="fw-bold">
                            Rp {{ number_format($product->selling_price, 0, ',', '.') }}
                        </h6>

                    </div>

                </div>


                <div class="d-flex gap-2">

                    <a href="{{ route('products.index') }}" class="btn btn-secondary">

                        Kembali

                    </a>

                    <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">

                        <i class="bi bi-pencil"></i>

                        Edit

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
