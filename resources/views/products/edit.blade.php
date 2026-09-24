@extends('layouts.app')

@section('title', 'Edit Item')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Edit Item
            </h4>

            <p class="text-muted mb-0">
                Perbarui data item
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('products.update', $product) }}" method="POST">

                    @csrf

                    @method('PUT')


                    <div class="row">

                        {{-- Kode --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Kode
                            </label>

                            <input type="text" name="code" value="{{ old('code', $product->code) }}"
                                class="form-control @error('code') is-invalid @enderror">

                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Nama --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nama Item
                            </label>

                            <input type="text" name="name" value="{{ old('name', $product->name) }}"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Supplier / Kategori --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Supplier (Kategori)
                            </label>

                            <input type="text" name="supplier_category"
                                value="{{ old('supplier_category', $product->supplier_category) }}"
                                class="form-control @error('supplier_category') is-invalid @enderror">

                            @error('supplier_category')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Stok --}}
                        <div class="col-md-3 mb-3">

                            <label class="form-label">
                                Stok
                            </label>

                            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0"
                                class="form-control @error('stock') is-invalid @enderror">

                            @error('stock')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Satuan --}}
                        <div class="col-md-3 mb-3">

                            <label class="form-label">
                                Satuan
                            </label>

                            <input type="text" name="unit" value="{{ old('unit', $product->unit) }}"
                                class="form-control @error('unit') is-invalid @enderror">

                            @error('unit')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Harga Beli --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Harga Beli
                            </label>

                            <input type="number" name="purchase_price"
                                value="{{ old('purchase_price', $product->purchase_price) }}" min="0"
                                class="form-control @error('purchase_price') is-invalid @enderror">

                            @error('purchase_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Harga Jual --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Harga Jual
                            </label>

                            <input type="number" name="selling_price"
                                value="{{ old('selling_price', $product->selling_price) }}" min="0"
                                class="form-control @error('selling_price') is-invalid @enderror">

                            @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    <div class="d-flex gap-2">

                        <a href="{{ route('products.index') }}" class="btn btn-light border">

                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali

                        </a>

                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-save me-1"></i>
                            Update

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
