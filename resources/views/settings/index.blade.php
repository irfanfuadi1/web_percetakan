@extends('layouts.app')

@section('title', 'Pengaturan')

@section('content')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">

        <h4 class="fw-bold mb-1">
            Pengaturan Toko
        </h4>

        <p class="text-muted mb-0">
            Kelola informasi toko dan pengaturan struk.
        </p>

    </div>


    


    {{-- FORM --}}
    <form
        action="{{ route('settings.update') }}"
        method="POST"
        enctype="multipart/form-data"
    >

        @csrf

        @method('PUT')


        <div class="card border-0 shadow-sm">

            <div class="card-body p-4">


                {{-- =====================================================
                    INFORMASI TOKO
                ====================================================== --}}

                <h5 class="fw-semibold mb-4">

                    <i class="bi bi-shop me-2"></i>

                    Informasi Toko & Struk

                </h5>


                <div class="row g-4">


                    {{-- KOLOM KIRI --}}
                    <div class="col-lg-8">


                        {{-- NAMA TOKO --}}
                        <div class="mb-3">

                            <label
                                for="store_name"
                                class="form-label"
                            >
                                Nama Toko
                            </label>

                            <input
                                type="text"
                                name="store_name"
                                id="store_name"
                                class="form-control"
                                value="{{ old('store_name', $setting->store_name) }}"
                                placeholder="Masukkan nama toko"
                                required
                            >

                        </div>


                        {{-- ALAMAT --}}
                        <div class="mb-3">

                            <label
                                for="address"
                                class="form-label"
                            >
                                Alamat
                            </label>

                            <textarea
                                name="address"
                                id="address"
                                rows="3"
                                class="form-control"
                                placeholder="Masukkan alamat toko"
                            >{{ old('address', $setting->address) }}</textarea>

                        </div>


                        {{-- NO TELEPON --}}
                        <div class="mb-3">

                            <label
                                for="phone"
                                class="form-label"
                            >
                                No. Telepon
                            </label>

                            <input
                                type="text"
                                name="phone"
                                id="phone"
                                class="form-control"
                                value="{{ old('phone', $setting->phone) }}"
                                placeholder="Masukkan nomor telepon"
                            >

                        </div>


                        {{-- FOOTER STRUK --}}
                        <div class="mb-3">

                            <label
                                for="receipt_footer"
                                class="form-label"
                            >
                                Catatan Kaki Struk (Footer)
                            </label>

                            <textarea
                                name="receipt_footer"
                                id="receipt_footer"
                                rows="4"
                                class="form-control"
                                placeholder="Contoh: Terima kasih atas kunjungan Anda"
                            >{{ old('receipt_footer', $setting->receipt_footer) }}</textarea>

                            <div class="form-text">
                                Teks ini akan muncul di bagian bawah struk.
                            </div>

                        </div>

                    </div>


                    {{-- =================================================
                        KOLOM KANAN
                    ================================================== --}}

                    <div class="col-lg-4">


                        {{-- LOGO --}}
                        <div class="mb-4">

                            <label
                                for="receipt_logo"
                                class="form-label"
                            >
                                Logo Struk
                            </label>


                            {{-- PREVIEW --}}
                            <div
                                class="receipt-logo-preview mb-2"
                            >

                                @if ($setting->receipt_logo)

                                    <img
                                        src="{{ asset('storage/' . $setting->receipt_logo) }}"
                                        alt="Logo Struk"
                                        id="logoPreview"
                                    >

                                @else

                                    <div
                                        class="receipt-logo-placeholder"
                                        id="logoPlaceholder"
                                    >
                                        <i class="bi bi-shop"></i>
                                    </div>

                                    <img
                                        src=""
                                        alt="Preview Logo"
                                        id="logoPreview"
                                        style="display: none;"
                                    >

                                @endif

                            </div>


                            {{-- FILE --}}
                            <input
                                type="file"
                                name="receipt_logo"
                                id="receipt_logo"
                                class="form-control"
                                accept=".jpg,.jpeg,.png"
                            >


                            <div class="form-text">

                                Format: JPG, PNG.
                                Maksimal 2MB.

                            </div>

                        </div>


                        {{-- UKURAN KERTAS --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Ukuran Kertas Struk
                            </label>


                            {{-- 80MM --}}
                            <div class="form-check form-switch mb-2">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="receipt_paper_size"
                                    value="80mm"
                                    id="paper80"
                                    {{ old('receipt_paper_size', $setting->receipt_paper_size) === '80mm' ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="paper80"
                                >
                                    80mm (Standard)
                                </label>

                            </div>


                            {{-- 58MM --}}
                            <div class="form-check form-switch">

                                <input
                                    class="form-check-input"
                                    type="radio"
                                    name="receipt_paper_size"
                                    value="58mm"
                                    id="paper58"
                                    {{ old('receipt_paper_size', $setting->receipt_paper_size) === '58mm' ? 'checked' : '' }}
                                >

                                <label
                                    class="form-check-label"
                                    for="paper58"
                                >
                                    58mm (Small)
                                </label>

                            </div>

                        </div>

                    </div>

                </div>

            </div>


            {{-- FOOTER CARD --}}
            <div class="card-footer bg-transparent border-top p-3 text-end">

                <button
                    type="submit"
                    class="btn btn-primary"
                >

                    <i class="bi bi-check-lg me-1"></i>

                    Simpan Pengaturan

                </button>

            </div>

        </div>

    </form>

</div>


@push('styles')

<style>

    /* =========================================================
       RECEIPT LOGO
    ========================================================== */

    .receipt-logo-preview {
        width: 90px;
        height: 90px;

        border: 1px solid #e1e1e1;

        border-radius: 12px;

        overflow: hidden;

        display: flex;
        align-items: center;
        justify-content: center;

        background: #f8f9fa;

        transition:
            background-color 0.3s ease,
            border-color 0.3s ease;
    }


    .receipt-logo-preview img {
        width: 100%;
        height: 100%;

        object-fit: contain;
    }


    .receipt-logo-placeholder {
        width: 100%;
        height: 100%;

        display: flex;
        align-items: center;
        justify-content: center;

        font-size: 32px;

        color: #999;
    }


    /* =========================================================
       DARK MODE
    ========================================================== */

    body.dark-mode .receipt-logo-preview {
        background: #252525;

        border-color: #3a3a3a;
    }


    body.dark-mode .receipt-logo-placeholder {
        color: #888;
    }


    body.dark-mode .form-text {
        color: #999 !important;
    }


    /* =========================================================
       FORM SWITCH
    ========================================================== */

    .form-check-input {
        cursor: pointer;
    }


    .form-check-label {
        cursor: pointer;
    }

</style>

@endpush


@push('scripts')

<script>

    document.addEventListener('DOMContentLoaded', function () {

        const logoInput =
            document.getElementById('receipt_logo');

        const logoPreview =
            document.getElementById('logoPreview');

        const logoPlaceholder =
            document.getElementById('logoPlaceholder');


        if (logoInput) {

            logoInput.addEventListener('change', function (event) {

                const file =
                    event.target.files[0];


                if (!file) {
                    return;
                }


                const reader =
                    new FileReader();


                reader.onload = function (e) {

                    logoPreview.src =
                        e.target.result;

                    logoPreview.style.display =
                        'block';


                    if (logoPlaceholder) {

                        logoPlaceholder.style.display =
                            'none';

                    }

                };


                reader.readAsDataURL(file);

            });

        }

    });

</script>

@endpush

@endsection