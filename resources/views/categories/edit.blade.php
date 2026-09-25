@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">
            <h4 class="fw-bold mb-1">Edit Kategori</h4>
            <p class="text-muted">
                Perbarui informasi kategori
            </p>
        </div>

        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('categories.update', $category) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="mb-3">

                        <label class="form-label">
                            Nama Kategori
                        </label>

                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                            value="{{ old('name', $category->name) }}">

                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Deskripsi
                        </label>

                        <textarea name="description" rows="4" class="form-control">{{ old('description', $category->description) }}</textarea>

                    </div>

                    <div class="mb-4">

                        <label class="form-label">
                            Status
                        </label>

                        <select name="is_active" class="form-select">

                            <option value="1" {{ $category->is_active ? 'selected' : '' }}>
                                Aktif
                            </option>

                            <option value="0" {{ !$category->is_active ? 'selected' : '' }}>
                                Tidak Aktif
                            </option>

                        </select>

                    </div>

                    <div class="d-flex gap-2">

                        <a href="{{ route('categories.index') }}" class="btn btn-light border">
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
