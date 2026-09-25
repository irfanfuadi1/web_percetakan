@extends('layouts.app')

@section('title', 'Master Kas')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="d-flex justify-content-between align-items-center mb-4">

        <div>
            <h4 class="fw-bold mb-1">
                Master Kas / Akun Keuangan
            </h4>

            <p class="text-muted mb-0">
                Kelola kas dan akun keuangan percetakan
            </p>
        </div>

        <a href="{{ route('cash-accounts.create') }}"
           class="btn btn-primary">

            <i class="bi bi-plus-lg"></i>
            Tambah Akun Kas

        </a>

    </div>


    {{-- SUCCESS NOTIFICATION --}}
    @if(session('success'))

        <div id="successAlert" class="alert alert-success alert-dismissible fade show"
             role="alert">

            <i class="bi bi-check-circle me-2"></i>

            {{ session('success') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
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

                            <th>
                                Nama Kas
                            </th>

                            <th>
                                Jenis
                            </th>

                            <th>
                                Saldo Saat Ini
                            </th>

                            <th>
                                Keterangan
                            </th>

                            <th class="text-center">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($cashAccounts as $cashAccount)

                            <tr>

                                {{-- NAMA --}}
                                <td>

                                    <span class="fw-semibold">
                                        {{ $cashAccount->name }}
                                    </span>

                                </td>


                                {{-- JENIS --}}
                                <td>

                                    @if($cashAccount->type === 'Kas')

                                        <span class="badge bg-success">
                                            Kas
                                        </span>

                                    @elseif($cashAccount->type === 'Bank')

                                        <span class="badge bg-primary">
                                            Bank
                                        </span>

                                    @elseif($cashAccount->type === 'E-Wallet')

                                        <span class="badge bg-warning text-dark">
                                            E-Wallet
                                        </span>

                                    @endif

                                </td>


                                {{-- SALDO --}}
                                <td>

                                    <span class="fw-semibold">
                                        Rp {{ number_format($cashAccount->balance, 0, ',', '.') }}
                                    </span>

                                </td>


                                {{-- KETERANGAN --}}
                                <td>

                                    {{ $cashAccount->description ?? '-' }}

                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="d-flex justify-content-center gap-2">

                                        {{-- DETAIL --}}
                                        <a href="{{ route('cash-accounts.show', $cashAccount) }}"
                                           class="btn btn-sm btn-outline-primary"
                                           title="Detail">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- EDIT --}}
                                        <a href="{{ route('cash-accounts.edit', $cashAccount) }}"
                                           class="btn btn-sm btn-outline-warning"
                                           title="Edit">

                                            <i class="bi bi-pencil"></i>

                                        </a>


                                        {{-- HAPUS --}}
                                        <form action="{{ route('cash-accounts.destroy', $cashAccount) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Apakah Anda yakin ingin menghapus kas / akun ini?');">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-sm btn-outline-danger"
                                                    title="Hapus">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="bi bi-cash-stack fs-2 d-block mb-2"></i>

                                        <div>
                                            Belum ada data master kas / akun.
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            @if($cashAccounts->hasPages())

                <div class="mt-3">

                    {{ $cashAccounts->links() }}

                </div>

            @endif

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