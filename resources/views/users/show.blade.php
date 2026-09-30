@extends('layouts.app')

@section('title', 'Detail User')

@section('content')

    <div class="container-fluid">

        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Detail User
            </h4>

            <p class="text-muted mb-0">
                Informasi pengguna sistem.
            </p>

        </div>


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="row g-4">

                    <div class="col-md-6">

                        <label class="text-muted small">
                            Username
                        </label>

                        <div class="fw-semibold">
                            {{ $user->username }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="text-muted small">
                            Nama Lengkap
                        </label>

                        <div class="fw-semibold">
                            {{ $user->name }}
                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="text-muted small">
                            Role
                        </label>

                        <div>

                            <span class="badge rounded-pill bg-secondary">

                                {{ $user->role }}

                            </span>

                        </div>

                    </div>


                    <div class="col-md-6">

                        <label class="text-muted small">
                            Dibuat
                        </label>

                        <div>
                            {{ $user->created_at?->format('d/m/Y H:i') ?? '-' }}
                        </div>

                    </div>

                </div>


                <hr class="my-4">


                <div class="d-flex gap-2">

                    <a href="{{ route('users.index') }}" class="btn btn-light border">

                        <i class="bi bi-arrow-left me-1"></i>

                        Kembali

                    </a>


                    <a href="{{ route('users.edit', $user) }}" class="btn btn-primary">

                        <i class="bi bi-pencil me-1"></i>

                        Edit User

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
