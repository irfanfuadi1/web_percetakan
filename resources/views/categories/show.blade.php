@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">
            <h4 class="fw-bold mb-1">Detail Kategori</h4>
            <p class="text-muted">
                Informasi detail kategori
            </p>
        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="mb-3">
                    <label class="text-muted">
                        Nama Kategori
                    </label>

                    <h5>
                        {{ $category->name }}
                    </h5>
                </div>

                <div class="mb-3">
                    <label class="text-muted">
                        Deskripsi
                    </label>

                    <p>
                        {{ $category->description ?? '-' }}
                    </p>
                </div>

                <div class="mb-4">
                    <label class="text-muted">
                        Status
                    </label>

                    <div>
                        @if ($category->is_active)
                            <span class="badge bg-success">
                                Aktif
                            </span>
                        @else
                            <span class="badge bg-secondary">
                                Tidak Aktif
                            </span>
                        @endif
                    </div>
                </div>

                <div class="d-flex gap-2">

                    <a href="{{ route('categories.index') }}" class="btn btn-light border">
                        <i class="bi bi-arrow-left me-1"></i>
                        Kembali
                    </a>

                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning">
                        <i class="bi bi-pencil me-1"></i>
                        Edit
                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
