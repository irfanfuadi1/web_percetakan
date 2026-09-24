@extends('layouts.app')

@section('title', 'Detail Pelanggan')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Detail Pelanggan
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap pelanggan
            </p>

        </div>


        {{-- DETAIL --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row">

                    {{-- KODE --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small">
                            Kode Pelanggan
                        </label>

                        <div class="fw-semibold">
                            {{ $customer->code }}
                        </div>

                    </div>


                    {{-- NAMA --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small">
                            Nama Pelanggan
                        </label>

                        <div class="fw-semibold">
                            {{ $customer->name }}
                        </div>

                    </div>


                    {{-- JENIS PELANGGAN --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small">
                            Jenis Pelanggan
                        </label>

                        <div>

                            @if ($customer->customer_type === 'Member')
                                <span class="badge bg-primary">
                                    Member
                                </span>
                            @else
                                <span class="badge bg-secondary">
                                    Umum
                                </span>
                            @endif

                        </div>

                    </div>


                    {{-- NO HP --}}
                    <div class="col-md-6 mb-4">

                        <label class="text-muted small">
                            No. HP
                        </label>

                        <div class="fw-semibold">
                            {{ $customer->phone ?? '-' }}
                        </div>

                    </div>


                    {{-- ALAMAT --}}
                    <div class="col-md-12 mb-4">

                        <label class="text-muted small">
                            Alamat
                        </label>

                        <div class="fw-semibold">
                            {{ $customer->address ?? '-' }}
                        </div>

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="d-flex gap-2">

                    <a href="{{ route('customers.index') }}" class="btn btn-light border">

                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <a href="{{ route('customers.edit', $customer) }}" class="btn btn-warning">

                        <i class="bi bi-pencil me-1"></i>
                        Edit

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
