@extends('layouts.app')

@section('title', 'Pelanggan')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Data Pelanggan</h4>

                <p class="text-muted mb-0">
                    Kelola data pelanggan
                </p>
            </div>

            <a href="{{ route('customers.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg me-1"></i>
                Tambah Pelanggan
            </a>

        </div>


        {{-- NOTIFICATION --}}
        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                </button>

            </div>
        @endif


        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th class="px-4">Kode</th>

                                <th>Nama</th>

                                <th>Jenis Pelanggan</th>

                                <th>No. HP</th>

                                <th>Alamat</th>

                                <th class="text-center" width="150">
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($customers as $customer)
                                <tr>

                                    {{-- KODE --}}
                                    <td class="px-4 fw-semibold">
                                        {{ $customer->code }}
                                    </td>


                                    {{-- NAMA --}}
                                    <td>
                                        {{ $customer->name }}
                                    </td>


                                    {{-- JENIS PELANGGAN --}}
                                    <td>

                                        @if ($customer->customer_type === 'Member')
                                            <span class="badge bg-primary">
                                                Member
                                            </span>
                                        @else
                                            <span class="badge bg-secondary">
                                                Umum
                                            </span>
                                        @endif

                                    </td>


                                    {{-- NO HP --}}
                                    <td>
                                        {{ $customer->phone ?? '-' }}
                                    </td>


                                    {{-- ALAMAT --}}
                                    <td>
                                        {{ $customer->address ?? '-' }}
                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <div class="d-flex justify-content-center gap-1">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('customers.show', $customer) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDIT --}}
                                            <a href="{{ route('customers.edit', $customer) }}"
                                                class="btn btn-sm btn-outline-warning"
                                                title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form action="{{ route('customers.destroy', $customer) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus pelanggan ini?');">

                                                @csrf

                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger"
                                                    title="Hapus">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-5 text-muted">

                                        <i class="bi bi-people fs-2 d-block mb-2"></i>

                                        Belum ada data pelanggan.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}
            @if ($customers->hasPages())
                <div class="card-footer bg-white border-0">

                    {{ $customers->links() }}

                </div>
            @endif

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const successAlert = document.getElementById('successAlert');

            if (successAlert) {
                setTimeout(function() {
                    const alert = bootstrap.Alert.getOrCreateInstance(successAlert);
                    alert.close();
                }, 5000);
            }
        });
    </script>
@endpush
