@extends('layouts.app')

@section('title', 'Detail Supplier')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Detail Supplier
            </h4>

            <p class="text-muted mb-0">
                Informasi lengkap supplier
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Kode Supplier
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $supplier->code }}
                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Nama Supplier
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $supplier->name }}
                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            Produk
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $supplier->product }}
                        </div>

                    </div>


                    <div class="col-md-6 mb-4">

                        <small class="text-muted">
                            No. HP
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $supplier->phone ?? '-' }}
                        </div>

                    </div>


                    <div class="col-12 mb-4">

                        <small class="text-muted">
                            Alamat
                        </small>

                        <div class="fw-semibold mt-1">
                            {{ $supplier->address ?? '-' }}
                        </div>

                    </div>

                </div>


                <div class="d-flex justify-content-end gap-2">

                    <a href="{{ route('suppliers.index') }}" class="btn btn-light border">

                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali

                    </a>

                    <a href="{{ route('suppliers.edit', $supplier) }}" class="btn btn-primary">

                        <i class="bi bi-pencil"></i>
                        Edit

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
