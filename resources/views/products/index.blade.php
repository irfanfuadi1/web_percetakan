@extends('layouts.app')

@section('title', 'Master Item')

@section('content')

    <div class="container-fluid">

        {{-- Header --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Master Item
                </h4>

                <p class="text-muted mb-0">
                    Kelola data barang dan jasa percetakan
                </p>
            </div>

            <a href="{{ route('products.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-lg"></i>

                Tambah Item

            </a>

        </div>


        {{-- Success Message --}}
        @if (session('success'))
            <div id="successAlert" class="alert alert-success alert-dismissible fade show" role="alert">

                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>

            </div>
        @endif


        {{-- Error Message --}}
        @if ($errors->any())

            <div class="alert alert-danger">

                <ul class="mb-0">

                    @foreach ($errors->all() as $error)
                        <li>
                            {{ $error }}
                        </li>
                    @endforeach

                </ul>

            </div>

        @endif


        {{-- Table --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover align-middle">

                        <thead>

                            <tr>

                                <th width="50">
                                    No
                                </th>

                                <th>
                                    Kode
                                </th>

                                <th>
                                    Nama Item
                                </th>

                                <th>
                                    Supplier (Kategori)
                                </th>

                                <th>
                                    Stok
                                </th>

                                <th>
                                    Satuan
                                </th>

                                <th>
                                    Harga Beli
                                </th>

                                <th>
                                    Harga Jual
                                </th>

                                <th width="150">
                                    Aksi
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse($products as $product)
                                <tr>

                                    <td>
                                        {{ $products->firstItem() + $loop->index }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $product->code }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $product->name }}
                                    </td>

                                    <td>
                                        {{ $product->supplier_category }}
                                    </td>

                                    <td>
                                        {{ $product->stock }}
                                    </td>

                                    <td>
                                        {{ $product->unit }}
                                    </td>

                                    <td>
                                        Rp
                                        {{ number_format($product->purchase_price, 0, ',', '.') }}
                                    </td>

                                    <td>
                                        Rp
                                        {{ number_format($product->selling_price, 0, ',', '.') }}
                                    </td>

                                    <td>

                                        {{-- Detail --}}
                                        <a href="{{ route('products.show', $product) }}"
                                            class="btn btn-sm btn-outline-info" title="Detail">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-warning"
                                            title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route('products.destroy', $product) }}" method="POST"
                                            class="d-inline" onsubmit="return confirm('Yakin ingin menghapus item ini?')">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center text-muted py-4">

                                        Belum ada data item.

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>


                {{-- Pagination --}}
                <div class="mt-3">

                    {{ $products->links() }}

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
