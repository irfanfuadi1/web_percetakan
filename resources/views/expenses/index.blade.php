@extends('layouts.app')

@section('title', 'Pengeluaran Operasional')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="fw-bold mb-1">
                    Pengeluaran Operasional
                </h4>

                <p class="text-muted mb-0">
                    Kelola transaksi pengeluaran operasional.
                </p>
            </div>

            <a href="{{ route('expenses.create') }}" class="btn btn-primary">

                <i class="bi bi-plus-lg me-1"></i>

                Tambah Pengeluaran

            </a>

        </div>


        


        {{-- TOTAL PENGELUARAN --}}
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <div class="row">

                    <div class="col-md-4">

                        <div class="rounded-3 p-3 bg-danger text-white">

                            <div class="small mb-1">
                                Total Pengeluaran (Periode Ini)
                            </div>

                            <h4 class="fw-bold mb-1">

                                Rp
                                {{ number_format($totalExpense, 0, ',', '.') }}

                            </h4>

                            <small>
                                {{ \Carbon\Carbon::parse($fromDate)->format('d M Y') }}
                                -
                                {{ \Carbon\Carbon::parse($toDate)->format('d M Y') }}
                            </small>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- FILTER --}}
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <form action="{{ route('expenses.index') }}" method="GET">

                    <div class="row align-items-end g-3">

                        <div class="col-md-3">

                            <label class="form-label fw-semibold">
                                Dari Tanggal
                            </label>

                            <input type="date" name="from_date" class="form-control" value="{{ $fromDate }}">

                        </div>


                        <div class="col-md-3">

                            <label class="form-label fw-semibold">
                                Sampai Tanggal
                            </label>

                            <input type="date" name="to_date" class="form-control" value="{{ $toDate }}">

                        </div>


                        <div class="col-md-2">

                            <button type="submit" class="btn btn-primary">

                                <i class="bi bi-funnel me-1"></i>

                                Filter

                            </button>

                        </div>

                    </div>

                </form>

            </div>

        </div>


        {{-- TABLE --}}
        <div class="card border-0 shadow-sm">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table align-middle mb-0">

                        <thead>

                            <tr>

                                <th class="px-4">
                                    TANGGAL
                                </th>

                                <th>
                                    AKUN KAS
                                </th>

                                <th>
                                    KETERANGAN
                                </th>

                                <th>
                                    JUMLAH
                                </th>

                                <th>
                                    AKSI
                                </th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse ($expenses as $expense)
                                <tr>

                                    <td class="px-4">

                                        {{ $expense->expense_date->format('d/m/Y') }}

                                    </td>


                                    <td>

                                        <div class="fw-semibold">

                                            {{ $expense->cashAccount->name }}

                                        </div>

                                        <small class="text-muted">

                                            {{ $expense->cashAccount->type }}

                                        </small>

                                    </td>


                                    <td>

                                        {{ $expense->description }}

                                    </td>


                                    <td>

                                        <span class="fw-semibold">

                                            Rp
                                            {{ number_format($expense->amount, 0, ',', '.') }}

                                        </span>

                                    </td>


                                    <td>

                                        <div class="d-flex gap-2">

                                            <a href="{{ route('expenses.show', $expense) }}"
                                                class="btn btn-sm btn-outline-info" title="Detail">

                                                <i class="bi bi-eye"></i>

                                            </a>


                                            <a href="{{ route('expenses.edit', $expense) }}"
                                                class="btn btn-sm btn-outline-warning" title="Edit">

                                                <i class="bi bi-pencil"></i>

                                            </a>


                                            <form action="{{ route('expenses.destroy', $expense) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus pengeluaran ini? Saldo akun kas akan dikembalikan.')">

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

                                    <td colspan="5" class="text-center py-5">

                                        <i class="bi bi-wallet2 fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">

                                            Belum ada pengeluaran

                                        </div>

                                        <small class="text-muted">

                                            Belum ada pengeluaran pada periode yang dipilih.

                                        </small>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>


        {{-- PAGINATION --}}
        <div class="mt-3">

            {{ $expenses->links() }}

        </div>

    </div>

@endsection


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const successAlert = document.getElementById('successAlert');

            if (successAlert) {

                setTimeout(function() {

                    const alert =
                        bootstrap.Alert.getOrCreateInstance(successAlert);

                    alert.close();

                }, 5000);

            }

        });
    </script>
@endpush
