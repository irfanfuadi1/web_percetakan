@extends('layouts.app')

@section('title', 'Riwayat Aktivitas')

@section('content')

    <div class="container-fluid">

        {{-- HEADER --}}
        <div class="mb-4">

            <h4 class="fw-bold mb-1">
                Riwayat Aktivitas
            </h4>

            <p class="text-muted mb-0">
                Pantau aktivitas pengguna sistem.
            </p>

        </div>


        {{-- FILTER --}}
        <div class="card border-0 shadow-sm mb-3">

            <div class="card-body">

                <form
                    action="{{ route('activity-logs.index') }}"
                    method="GET"
                >

                    <div class="row g-2 align-items-end">

                        {{-- CARI USER --}}
                        <div class="col-md-3">

                            <label class="form-label visually-hidden">
                                Cari User
                            </label>

                            <input
                                type="text"
                                name="user"
                                class="form-control"
                                value="{{ request('user') }}"
                                placeholder="Cari User..."
                            >

                        </div>


                        {{-- TANGGAL --}}
                        <div class="col-md-3">

                            <label class="form-label visually-hidden">
                                Tanggal
                            </label>

                            <input
                                type="date"
                                name="date"
                                class="form-control"
                                value="{{ request('date') }}"
                            >

                        </div>


                        {{-- FILTER --}}
                        <div class="col-md-auto">

                            <button
                                type="submit"
                                class="btn btn-primary"
                            >

                                <i class="bi bi-search me-1"></i>

                                Filter

                            </button>

                        </div>


                        {{-- RESET --}}
                        @if (request()->filled('user') || request()->filled('date'))

                            <div class="col-md-auto">

                                <a
                                    href="{{ route('activity-logs.index') }}"
                                    class="btn btn-light border"
                                >

                                    <i class="bi bi-arrow-clockwise me-1"></i>

                                    Reset

                                </a>

                            </div>

                        @endif

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
                                    WAKTU
                                </th>

                                <th>
                                    USER
                                </th>

                                <th>
                                    ROLE
                                </th>

                                <th>
                                    AKSI
                                </th>

                                <th>
                                    DESKRIPSI
                                </th>

                            </tr>

                        </thead>


                        <tbody>

                            @forelse ($activityLogs as $activity)

                                <tr>

                                    {{-- WAKTU --}}
                                    <td class="px-4 text-nowrap">

                                        {{ $activity->created_at->format('d/m/Y H:i') }}

                                    </td>


                                    {{-- USER --}}
                                    <td>

                                        @if ($activity->user)

                                            <span class="fw-semibold">
                                                {{ $activity->user->username }}
                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- ROLE --}}
                                    <td>

                                        @if ($activity->user)

                                            <span class="badge rounded-pill bg-secondary">

                                                {{ strtoupper($activity->user->role) }}

                                            </span>

                                        @else

                                            <span class="text-muted">
                                                -
                                            </span>

                                        @endif

                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        <span class="fw-semibold">
                                            {{ $activity->action }}
                                        </span>

                                    </td>


                                    {{-- DESKRIPSI --}}
                                    <td>

                                        <span>
                                            {{ $activity->description }}
                                        </span>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td
                                        colspan="5"
                                        class="text-center py-5"
                                    >

                                        <i class="bi bi-clock-history fs-1 text-muted"></i>

                                        <div class="fw-semibold mt-3">
                                            Belum ada aktivitas
                                        </div>

                                        <small class="text-muted">
                                            Aktivitas pengguna akan muncul di halaman ini.
                                        </small>

                                    </td>

                                </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>


            {{-- PAGINATION --}}
            @if ($activityLogs->hasPages())

                <div class="card-footer bg-white border-0">

                    {{ $activityLogs->links() }}

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