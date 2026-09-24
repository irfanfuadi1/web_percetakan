@extends('layouts.app')

@section('title', 'Tambah Supplier')

@section('content')

<div class="container-fluid">

    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Tambah Supplier
        </h4>

        <p class="text-muted mb-0">
            Tambahkan data supplier baru
        </p>

    </div>


    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('suppliers.store') }}" method="POST">

                @csrf

                <div class="row">

                    {{-- KODE --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Kode Supplier
                        </label>

                        <input type="text"
                               name="code"
                               class="form-control @error('code') is-invalid @enderror"
                               value="{{ old('code') }}"
                               placeholder="Contoh: SPL001">

                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NAMA --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            Nama Supplier
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}"
                               placeholder="Masukkan nama supplier">

                        @error('name')
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

                        <input type="text"
                               name="product"
                               class="form-control @error('product') is-invalid @enderror"
                               value="{{ old('product') }}"
                               placeholder="Contoh: Kertas A4">

                        @error('product')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NO HP --}}
                    <div class="col-md-6 mb-3">

                        <label class="form-label">
                            No. HP
                        </label>

                        <input type="text"
                               name="phone"
                               class="form-control @error('phone') is-invalid @enderror"
                               value="{{ old('phone') }}"
                               placeholder="Contoh: 081234567890">

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ALAMAT --}}
                    <div class="col-12 mb-3">

                        <label class="form-label">
                            Alamat
                        </label>

                        <textarea name="address"
                                  rows="4"
                                  class="form-control @error('address') is-invalid @enderror"
                                  placeholder="Masukkan alamat supplier">{{ old('address') }}</textarea>

                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('suppliers.index') }}"
                       class="btn btn-light border">

                       <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <button type="submit"
                            class="btn btn-primary">

                        <i class="bi bi-save me-1"></i>
                        Simpan

                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection