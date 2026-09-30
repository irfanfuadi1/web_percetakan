@extends('layouts.app')

@section('title', 'Tambah User')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Tambah User
            </h4>

            <p class="text-muted mb-0">
                Tambahkan pengguna baru ke dalam sistem.
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <form action="{{ route('users.store') }}" method="POST">

                    @csrf


                    <div class="row g-3">

                        {{-- USERNAME --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Username
                            </label>

                            <input type="text" name="username"
                                class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}"
                                placeholder="Contoh: desainer1" required>

                            @error('username')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- NAMA LENGKAP --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nama Lengkap
                            </label>

                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Contoh: Desainer 1" required>

                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- ROLE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Role
                            </label>

                            <select name="role" class="form-select @error('role') is-invalid @enderror" required>

                                <option value="">
                                    -- Pilih Role --
                                </option>

                                <option value="admin" {{ old('role') === 'admin' ? 'selected' : '' }}>
                                    Admin
                                </option>

                                <option value="desainer" {{ old('role') === 'desainer' ? 'selected' : '' }}>
                                    Desainer
                                </option>

                            </select>

                            @error('role')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- PASSWORD --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Password
                            </label>

                            <input type="password" name="password"
                                class="form-control @error('password') is-invalid @enderror"
                                placeholder="Minimal 6 karakter" required>

                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- KONFIRMASI PASSWORD --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Konfirmasi Password
                            </label>

                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Ulangi password" required>

                        </div>

                    </div>


                    <hr class="my-4">


                    <div class="d-flex gap-2">

                        <a href="{{ route('users.index') }}" class="btn btn-light border w-50">

                            <i class="bi bi-arrow-left me-1"></i>

                            Kembali

                        </a>


                        <button type="submit" class="btn btn-primary w-50">

                            <i class="bi bi-save me-1"></i>

                            Simpan User

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
