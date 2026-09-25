@extends('layouts.app')

@section('title', 'Detail Kas / Akun')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Detail Kas / Akun
        </h4>

        <p class="text-muted mb-0">
            Informasi lengkap kas atau akun
        </p>

    </div>


    {{-- DETAIL CARD --}}
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <div class="row">

                {{-- NAMA --}}
                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Nama Kas / Akun
                    </small>

                    <div class="fw-semibold mt-1">
                        {{ $cashAccount->name }}
                    </div>

                </div>


                {{-- JENIS --}}
                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Jenis
                    </small>

                    <div class="mt-1">

                        @if($cashAccount->type === 'Kas')

                            <span class="badge bg-success">
                                Kas
                            </span>

                        @elseif($cashAccount->type === 'Bank')

                            <span class="badge bg-primary">
                                Bank
                            </span>

                        @elseif($cashAccount->type === 'E-Wallet')

                            <span class="badge bg-warning text-dark">
                                E-Wallet
                            </span>

                        @endif

                    </div>

                </div>


                {{-- SALDO --}}
                <div class="col-md-6 mb-4">

                    <small class="text-muted">
                        Saldo
                    </small>

                    <div class="fw-semibold mt-1">
                        Rp {{ number_format($cashAccount->balance, 0, ',', '.') }}
                    </div>

                </div>


                {{-- KETERANGAN --}}
                <div class="col-12 mb-4">

                    <small class="text-muted">
                        Keterangan
                    </small>

                    <div class="fw-semibold mt-1">

                        {{ $cashAccount->description ?? '-' }}

                    </div>

                </div>

            </div>


            {{-- BUTTON --}}
            <div class="d-flex justify-content-end gap-2">

                <a href="{{ route('cash-accounts.index') }}"
                   class="btn btn-light border">

                    <i class="bi bi-arrow-left me-1"></i>
                    Kembali

                </a>

                <a href="{{ route('cash-accounts.edit', $cashAccount) }}"
                   class="btn btn-warning">

                    <i class="bi bi-pencil me-1"></i>
                    Edit

                </a>

            </div>

        </div>

    </div>

</div>

@endsection