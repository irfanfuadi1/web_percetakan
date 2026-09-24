@extends('layouts.app')

@section('title', 'Tambah Pelanggan')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Tambah Pelanggan
            </h4>

            <p class="text-muted mb-0">
                Tambahkan data pelanggan baru
            </p>

        </div>


        {{-- FORM --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('customers.store') }}" method="POST">

                    @csrf


                    {{-- KODE --}}
                    <div class="mb-3">

                        <label for="code" class="form-label fw-semibold">
                            Kode Pelanggan
                        </label>

                        <input type="text" name="code" id="code"
                            class="form-control @error('code') is-invalid @enderror" value="{{ old('code') }}"
                            placeholder="Contoh: CUST001">

                        @error('code')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NAMA --}}
                    <div class="mb-3">

                        <label for="name" class="form-label fw-semibold">
                            Nama Pelanggan
                        </label>

                        <input type="text" name="name" id="name"
                            class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                            placeholder="Masukkan nama pelanggan">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- JENIS PELANGGAN --}}
                    <div class="mb-3">

                        <label for="customer_type" class="form-label fw-semibold">
                            Jenis Pelanggan
                        </label>

                        <select name="customer_type" id="customer_type"
                            class="form-select @error('customer_type') is-invalid @enderror">

                            <option value="">
                                -- Pilih Jenis Pelanggan --
                            </option>

                            <option value="Member" {{ old('customer_type') === 'Member' ? 'selected' : '' }}>
                                Member
                            </option>

                            <option value="Umum" {{ old('customer_type') === 'Umum' ? 'selected' : '' }}>
                                Umum
                            </option>

                        </select>

                        @error('customer_type')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- NO HP --}}
                    <div class="mb-3">

                        <label for="phone" class="form-label fw-semibold">
                            No. HP
                        </label>

                        <input type="text" name="phone" id="phone"
                            class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}"
                            placeholder="Contoh: 081234567890">

                        @error('phone')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- ALAMAT --}}
                    <div class="mb-4">

                        <label for="address" class="form-label fw-semibold">
                            Alamat
                        </label>

                        <textarea name="address" id="address" rows="4" class="form-control @error('address') is-invalid @enderror"
                            placeholder="Masukkan alamat pelanggan">{{ old('address') }}</textarea>

                        @error('address')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- BUTTON --}}
                    <div class="d-flex gap-2">

                        <a href="{{ route('customers.index') }}" class="btn btn-light border">

                            <i class="bi bi-arrow-left me-1"></i>
                            Kembali

                        </a>

                        <button type="submit" class="btn btn-primary">

                            <i class="bi bi-save me-1"></i>
                            Simpan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
