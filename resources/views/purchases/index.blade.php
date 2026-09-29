@extends('layouts.app')

@section('title', 'Pembelian')

@section('content')

    <div class="container-fluid">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Pembelian
                </h4>

                <p class="text-muted mb-0">
                    Kelola transaksi pembelian barang dari supplier.
                </p>
            </div>

            <a href="{{ route('purchases.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-lg me-1"></i>

                Buat Pembelian Baru

            </a>

        </div>


        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show">

                <i class="bi bi-check-circle me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>
        @endif


        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="px-4">
                                    Kode Pembelian
                                </th>

                                <th>
                                    Tanggal
                                </th>

                                <th>
                                    Supplier
                                </th>

                                <th>
                                    Produk
                                </th>

                                <th>
                                    Total
                                </th>

                                <th>
                                    Dibayar
                                </th>

                                <th>
                                    Status
                                </th>

                                <th>
                                    Aksi
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($purchases as $purchase)
                                <tr>

                                    <td class="px-4">

                                        <div class="fw-semibold">
                                            {{ $purchase->purchase_code }}
                                        </div>

                                    </td>


                                    <td>

                                        <div>
                                            {{ $purchase->purchase_date->format('d/m/Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $purchase->purchase_date->format('H:i') }}
                                        </small>

                                    </td>


                                    <td>

                                        {{ $purchase->supplier->name }}

                                    </td>


                                    <td>

                                        <div class="fw-semibold">
                                            {{ $purchase->product->name }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $purchase->quantity }}
                                            {{ $purchase->unit }}
                                        </small>

                                    </td>


                                    <td>

                                        <span class="fw-semibold">

                                            Rp
                                            {{ number_format($purchase->total, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    <td>

                                        Rp
                                        {{ number_format($purchase->paid, 0, ',', '.') }}

                                    </td>


                                    <td>

                                        @if ($purchase->status === 'LUNAS')
                                            <span class="badge rounded-pill bg-success-subtle text-success">
                                                LUNAS
                                            </span>
                                        @else
                                            <span class="badge rounded-pill bg-warning-subtle text-warning">
                                                BELUM LUNAS
                                            </span>
                                        @endif

                                    </td>


                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="{{ route('purchases.show', $purchase) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            <a href="{{ route('purchases.edit', $purchase) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <form
                                                action="{{ route('purchases.destroy', $purchase) }}"
                                                method="POST"
                                                onsubmit="return confirm(
                                                  'Yakin ingin menghapus pembelian ini? Stok akan disesuaikan kembali.'
                                              )">

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

                                    <td colspan="8" class="text-center py-5">

                                        <i class="bi bi-bag fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">
                                            Belum ada transaksi pembelian
                                        </div>

                                        <small class="text-muted">
                                            Tambahkan transaksi pembelian untuk mulai mencatat stok.
                                        </small>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        <div class="mt-3">

            {{ $purchases->links() }}

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