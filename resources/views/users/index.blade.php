@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h4 class="fw-bold mb-1">
                    Manajemen User
                </h4>

                <p class="text-muted mb-0">
                    Kelola pengguna dan hak akses sistem.
                </p>

            </div>


            <a href="{{ route('users.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-lg me-1"></i>

                Tambah User

            </a>

        </div>


        


        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="px-4">
                                    USERNAME
                                </th>

                                <th>
                                    NAMA
                                </th>

                                <th>
                                    ROLE
                                </th>

                                <th>
                                    AKSI
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($users as $user)
                                <tr>

                                    {{-- USERNAME --}}
                                    <td class="px-4">

                                        <span class="fw-semibold">
                                            {{ $user->username }}
                                        </span>

                                    </td>


                                    {{-- NAMA LENGKAP --}}
                                    <td>

                                        {{ $user->name }}

                                    </td>


                                    {{-- ROLE --}}
                                    <td>

                                        @if ($user->role === 'admin')
                                            <span class="badge rounded-pill bg-secondary">
                                                admin
                                            </span>
                                        @elseif ($user->role === 'desainer')
                                            <span class="badge rounded-pill bg-secondary">
                                                desainer
                                            </span>
                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="d-flex gap-2">

                                            {{-- EDIT --}}
                                            <a href="{{ route('users.edit', $user) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            @if ($user->role !== 'admin')
                                                <form action="{{ route('users.destroy', $user) }}" method="POST"
                                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')">

                                                    @csrf

                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                                        title="Hapus">

                                                        <i class="bi bi-trash"></i>

                                                    </button>

                                                </form>
                                            @endif

                                        </div>

                                    </td>

                                </tr>


                            @empty

                                <tr>

                                    <td colspan="4" class="text-center py-5">

                                        <i class="bi bi-people fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">
                                            Belum ada user
                                        </div>

                                        <small class="text-muted">
                                            Tambahkan user untuk menggunakan sistem.
                                        </small>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            @if ($users->hasPages())
                <div class="card-footer bg-white border-0">

                    {{ $users->links() }}

                </div>
            @endif

        </div>

    </div>


    <style>
        .table thead th {
            font-size: 12px;
            color: #6c757d;
            font-weight: 700;
            white-space: nowrap;
            background: #f8f9fa;
        }

        .table tbody td {
            font-size: 14px;
        }

        .table tbody tr:hover {
            background: #fafafa;
        }
    </style>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const successAlert =
                document.getElementById('successAlert');

            const errorAlert =
                document.getElementById('errorAlert');


            if (successAlert) {

                setTimeout(function() {

                    const alert =
                        bootstrap.Alert.getOrCreateInstance(
                            successAlert
                        );

                    alert.close();

                }, 5000);

            }


            if (errorAlert) {

                setTimeout(function() {

                    const alert =
                        bootstrap.Alert.getOrCreateInstance(
                            errorAlert
                        );

                    alert.close();

                }, 5000);

            }

        });
    </script>
@endpush
