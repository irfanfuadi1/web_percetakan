@extends('layouts.app')

@section('title', 'Supplier')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">Data Supplier</h4>
                <p class="text-muted mb-0">
                    Kelola data supplier percetakan
                </p>
            </div>

            <a href="{{ route('suppliers.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i>
                Tambah Supplier
            </a>

        </div>


        {{-- NOTIFICATION --}}
        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>
        @endif


        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>
                                <th>Kode</th>
                                <th>Nama Supplier</th>
                                <th>Produk</th>
                                <th>No. HP</th>
                                <th>Alamat</th>
                                <th class="text-center">Aksi</th>
                            </tr>

                        </thead>

                        <tbody>

                            @forelse($suppliers as $supplier)
                                <tr>

                                    <td>
                                        <span class="fw-semibold">
                                            {{ $supplier->code }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $supplier->name }}
                                    </td>

                                    <td>
                                        {{ $supplier->product }}
                                    </td>

                                    <td>
                                        {{ $supplier->phone ?? '-' }}
                                    </td>

                                    <td>
                                        {{ $supplier->address ?? '-' }}
                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            {{-- DETAIL --}}
                                            <a href="{{ route('suppliers.show', $supplier) }}"
                                                class="btn btn-sm btn-outline-primary" title="Detail">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            {{-- EDIT --}}
                                            <a href="{{ route('suppliers.edit', $supplier) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            {{-- HAPUS --}}
                                            <form action="{{ route('suppliers.destroy', $supplier) }}" method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus supplier ini?');">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="6" class="text-center py-5">

                                        <div class="text-muted">

                                            <i class="bi bi-truck fs-2 d-block mb-2"></i>

                                            Belum ada data supplier.

                                        </div>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                <div class="mt-3">

                    {{ $suppliers->links() }}

                </div>

            </div>

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
