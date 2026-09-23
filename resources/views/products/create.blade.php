@extends('layouts.app')

@section('title', 'Tambah Item')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Tambah Item
            </h4>

            <p class="text-muted mb-0">
                Tambahkan item baru ke dalam master item
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('products.store') }}" method="POST">

                    @csrf


                    <div class="row">

                        {{-- Kode --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Kode
                            </label>

                            <input type="text" name="code" value="{{ old('code') }}"
                                class="form-control @error('code') is-invalid @enderror" placeholder="Contoh: BRG001">

                            @error('code')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Nama Item --}}
                        <div class="col-md-6 mb-3">

                            <label class="form-label">
                                Nama Item
                            </label>

                            <input type="text" name="name" value="{{ old('name') }}"
                                class="form-control @error('name') is-invalid @enderror" placeholder="Contoh: Banner">

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

                            <input type="text" name="supplier_category" value="{{ old('supplier_category') }}"
                                class="form-control @error('supplier_category') is-invalid @enderror"
                                placeholder="Contoh: ATK">

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

                            <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0"
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

                            <input type="text" name="unit" value="{{ old('unit') }}"
                                class="form-control @error('unit') is-invalid @enderror" placeholder="Contoh: Rim">

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

                            <input type="number" name="purchase_price" value="{{ old('purchase_price', 0) }}"
                                min="0" class="form-control @error('purchase_price') is-invalid @enderror">

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

                            <input type="number" name="selling_price" value="{{ old('selling_price', 0) }}" min="0"
                                class="form-control @error('selling_price') is-invalid @enderror">

                            @error('selling_price')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Buttons --}}
                    <div class="d-flex gap-2 mt-3">

                        <a href="{{ route('products.index') }}" class="btn btn-secondary">

                            Kembali

                        </a>

                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-save"></i>

                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
