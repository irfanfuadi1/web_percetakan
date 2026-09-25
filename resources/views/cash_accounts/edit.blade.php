@extends('layouts.app')

@section('title', 'Edit Kas / Akun')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Edit Kas / Akun
        </h4>

        <p class="text-muted mb-0">
            Perbarui data kas atau akun
        </p>

    </div>


    {{-- FORM --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <form action="{{ route('cash-accounts.update', $cashAccount) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <div class="row">

                    {{-- NAMA KAS / AKUN --}}
                    <div class="col-md-6 mb-3">

                        <label for="name"
                               class="form-label">

                            Nama Kas / Akun

                        </label>

                        <input type="text"
                               id="name"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $cashAccount->name) }}"
                               placeholder="Contoh: Kas Utama">

                        @error('name')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- JENIS --}}
                    <div class="col-md-6 mb-3">

                        <label for="type"
                               class="form-label">

                            Jenis

                        </label>

                        <select id="type"
                                name="type"
                                class="form-select @error('type') is-invalid @enderror">

                            <option value="Kas"
                                {{ old('type', $cashAccount->type) === 'Kas' ? 'selected' : '' }}>
                                Kas
                            </option>

                            <option value="Bank"
                                {{ old('type', $cashAccount->type) === 'Bank' ? 'selected' : '' }}>
                                Bank
                            </option>

                            <option value="E-Wallet"
                                {{ old('type', $cashAccount->type) === 'E-Wallet' ? 'selected' : '' }}>
                                E-Wallet
                            </option>

                        </select>

                        @error('type')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- SALDO --}}
                    <div class="col-md-6 mb-3">

                        <label for="balance"
                               class="form-label">

                            Saldo

                        </label>

                        <div class="input-group">

                            <span class="input-group-text">
                                Rp
                            </span>

                            <input type="number"
                                   id="balance"
                                   name="balance"
                                   class="form-control @error('balance') is-invalid @enderror"
                                   value="{{ old('balance', $cashAccount->balance) }}"
                                   min="0"
                                   step="0.01">

                        </div>

                        @error('balance')

                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>


                    {{-- KETERANGAN --}}
                    <div class="col-12 mb-3">

                        <label for="description"
                               class="form-label">

                            Keterangan

                        </label>

                        <textarea id="description"
                                  name="description"
                                  rows="4"
                                  class="form-control @error('description') is-invalid @enderror"
                                  placeholder="Masukkan keterangan">{{ old('description', $cashAccount->description) }}</textarea>

                        @error('description')

                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>

                        @enderror

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex justify-content-end gap-2 mt-2">

                    <a href="{{ route('cash-accounts.index') }}"
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

@endsection