<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Kasir Percetakan')
    </title>


    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">


    <style>
        * {
            box-sizing: border-box;
        }


        body {
            background-color: #f7f8fc;
            color: #333;

            font-family:
                Arial,
                Helvetica,
                sans-serif;

            transition:
                background-color 0.3s ease,
                color 0.3s ease;
        }


        .app-wrapper {
            min-height: 100vh;
        }


        .main-content {
            margin-left: 250px;
            min-height: 100vh;

            background-color: #f7f8fc;

            transition:
                background-color 0.3s ease;
        }


        .content-wrapper {
            padding: 25px 30px;
        }


        /* =====================================================
           DARK MODE - GLOBAL
        ====================================================== */

        body.dark-mode {
            background-color: #121212;
            color: #e9ecef;
        }


        body.dark-mode .main-content {
            background-color: #121212;
        }


        body.dark-mode main {
            color: #e9ecef;
        }


        /* =====================================================
           CARD
        ====================================================== */

        body.dark-mode .card {
            background-color: #1e1e1e;
            color: #e9ecef;

            border-color: #333 !important;
        }


        body.dark-mode .card-header {
            background-color: #252525;
            color: #fff;

            border-color: #333;
        }


        body.dark-mode .card-footer {
            background-color: #252525;
            border-color: #333;
        }


        /* =====================================================
           TABLE
        ====================================================== */

        body.dark-mode .table {
            color: #e9ecef;

            --bs-table-bg: #1e1e1e;
            --bs-table-color: #e9ecef;
            --bs-table-border-color: #333;
        }


        body.dark-mode .table thead {
            background-color: #2a2a2a;
            color: #fff;
        }


        body.dark-mode .table tbody tr {
            border-color: #333;
        }


        body.dark-mode .table tbody tr:hover {
            background-color: #252525;
        }


        body.dark-mode .table td,
        body.dark-mode .table th {
            border-color: #333;
        }


        /* =====================================================
           FORM
        ====================================================== */

        body.dark-mode .form-control,
        body.dark-mode .form-select {
            background-color: #2a2a2a;

            color: #fff;

            border-color: #444;
        }


        body.dark-mode .form-control::placeholder {
            color: #aaa;
        }


        body.dark-mode .form-control:focus,
        body.dark-mode .form-select:focus {
            background-color: #2a2a2a;

            color: #fff;

            border-color: #6257e8;

            box-shadow:
                0 0 0 0.2rem rgba(98, 87, 232, 0.20);
        }


        body.dark-mode .form-select option {
            background-color: #2a2a2a;
            color: #fff;
        }


        body.dark-mode .input-group-text {
            background-color: #333;
            color: #fff;
            border-color: #444;
        }


        /* =====================================================
           MODAL
        ====================================================== */

        body.dark-mode .modal-content {
            background-color: #1e1e1e;
            color: #fff;

            border-color: #333;
        }


        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #333;
        }


        body.dark-mode .modal-body {
            color: #e9e9e9;
        }


        /* =====================================================
           TEXT
        ====================================================== */

        body.dark-mode .text-muted {
            color: #aaa !important;
        }


        body.dark-mode .text-dark {
            color: #fff !important;
        }


        body.dark-mode h1,
        body.dark-mode h2,
        body.dark-mode h3,
        body.dark-mode h4,
        body.dark-mode h5,
        body.dark-mode h6 {
            color: #fff;
        }


        /* =====================================================
           DROPDOWN
        ====================================================== */

        body.dark-mode .dropdown-menu {
            background-color: #1e1e1e;

            border-color: #333;

            box-shadow:
                0 8px 25px rgba(0, 0, 0, 0.30);
        }


        body.dark-mode .dropdown-item {
            color: #fff;
        }


        body.dark-mode .dropdown-item:hover,
        body.dark-mode .dropdown-item:focus {
            background-color: #333;
            color: #fff;
        }


        body.dark-mode .dropdown-divider {
            border-color: #333;
        }


        /* =====================================================
           BUTTON LIGHT
        ====================================================== */

        body.dark-mode .btn-light {
            background-color: #2a2a2a;

            color: #fff;

            border-color: #444;
        }


        body.dark-mode .btn-light:hover {
            background-color: #333;

            color: #fff;

            border-color: #555;
        }


        /* =====================================================
           BORDER
        ====================================================== */

        body.dark-mode .border {
            border-color: #444 !important;
        }


        body.dark-mode .border-top {
            border-top-color: #444 !important;
        }


        body.dark-mode .border-bottom {
            border-bottom-color: #444 !important;
        }


        /* =====================================================
           ALERT
        ====================================================== */

        body.dark-mode .alert-success {
            background-color: #143d28;
            color: #b8f5ce;
            border-color: #246b42;
        }


        body.dark-mode .alert-danger {
            background-color: #451c1c;
            color: #ffc1c1;
            border-color: #783434;
        }


        body.dark-mode .alert-warning {
            background-color: #463a16;
            color: #ffe69c;
            border-color: #705d20;
        }


        body.dark-mode .alert-info {
            background-color: #153b4a;
            color: #b6e8f7;
            border-color: #245d70;
        }


        /* =====================================================
           NAVBAR THEME BUTTON
        ====================================================== */

        .btn-navbar {
            width: 40px;
            height: 40px;

            border: none;
            border-radius: 50%;

            display: flex;
            align-items: center;
            justify-content: center;

            background-color: transparent;

            color: inherit;

            transition:
                background-color 0.3s ease,
                color 0.3s ease;
        }


        .btn-navbar:hover {
            background-color: rgba(0, 0, 0, 0.08);
        }


        body.dark-mode .btn-navbar {
            color: #ddd;
        }


        body.dark-mode .btn-navbar:hover {
            background-color: rgba(255, 255, 255, 0.10);
            color: #8b83ff;
        }


        .btn-navbar i {
            font-size: 18px;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 991px) {

            .main-content {
                margin-left: 0;
            }

        }
    </style>


    @stack('styles')

</head>


<body>

    <div class="app-wrapper">


        {{-- SIDEBAR --}}
        @include('layouts.sidebar')


        <div class="main-content">


            {{-- NAVBAR --}}
            @include('layouts.navbar')


            <main>


                {{-- =================================================
                    SUCCESS NOTIFICATION
                ================================================== --}}

                @if (session('success'))
                    <div id="successAlert" class="alert alert-success alert-dismissible fade show shadow-sm mx-4 mt-3"
                        role="alert">

                        <i class="bi bi-check-circle-fill me-2"></i>

                        {{ session('success') }}


                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                @endif


                {{-- =================================================
                    ERROR NOTIFICATION
                ================================================== --}}

                @if (session('error'))
                    <div id="errorAlert" class="alert alert-danger alert-dismissible fade show shadow-sm mx-4 mt-3"
                        role="alert">

                        <i class="bi bi-exclamation-circle-fill me-2"></i>

                        {{ session('error') }}


                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                @endif


                {{-- =================================================
                    VALIDATION ERROR
                ================================================== --}}

                @if ($errors->any())
                    <div id="validationAlert" class="alert alert-danger alert-dismissible fade show shadow-sm mx-4 mt-3"
                        role="alert">

                        <i class="bi bi-exclamation-triangle-fill me-2"></i>

                        {{ $errors->first() }}


                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                    </div>
                @endif


                {{-- CONTENT --}}
                @yield('content')


            </main>

        </div>

    </div>


    {{-- =========================================================
        BOOTSTRAP JS
    ========================================================== --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


    {{-- =========================================================
        DARK / LIGHT MODE
    ========================================================== --}}

    <script>
        document.addEventListener(
            'DOMContentLoaded',
            function() {


                const themeToggle =
                    document.getElementById('themeToggle');


                const themeIcon =
                    document.getElementById('themeIcon');


                /*
                |--------------------------------------------------------------------------
                | TERAPKAN THEME SAAT HALAMAN DIBUKA
                |--------------------------------------------------------------------------
                */

                const savedTheme =
                    localStorage.getItem('theme');


                if (savedTheme === 'dark') {

                    document.body.classList.add(
                        'dark-mode'
                    );


                    if (themeIcon) {

                        themeIcon.classList.remove(
                            'bi-moon-fill'
                        );

                        themeIcon.classList.add(
                            'bi-sun-fill'
                        );

                    }

                } else {

                    document.body.classList.remove(
                        'dark-mode'
                    );


                    if (themeIcon) {

                        themeIcon.classList.remove(
                            'bi-sun-fill'
                        );

                        themeIcon.classList.add(
                            'bi-moon-fill'
                        );

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | TOGGLE DARK / LIGHT
                |--------------------------------------------------------------------------
                */

                if (themeToggle) {

                    themeToggle.addEventListener(
                        'click',
                        function() {


                            const isDark =
                                document.body.classList.toggle(
                                    'dark-mode'
                                );


                            if (isDark) {

                                localStorage.setItem(
                                    'theme',
                                    'dark'
                                );


                                if (themeIcon) {

                                    themeIcon.classList.remove(
                                        'bi-moon-fill'
                                    );

                                    themeIcon.classList.add(
                                        'bi-sun-fill'
                                    );

                                }

                            } else {

                                localStorage.setItem(
                                    'theme',
                                    'light'
                                );


                                if (themeIcon) {

                                    themeIcon.classList.remove(
                                        'bi-sun-fill'
                                    );

                                    themeIcon.classList.add(
                                        'bi-moon-fill'
                                    );

                                }

                            }

                        }
                    );

                }


                /*
                |--------------------------------------------------------------------------
                | AUTO CLOSE NOTIFICATION - 5000 MS
                |--------------------------------------------------------------------------
                */

                const alerts = [

                    document.getElementById(
                        'successAlert'
                    ),

                    document.getElementById(
                        'errorAlert'
                    ),

                    document.getElementById(
                        'validationAlert'
                    )

                ];


                alerts.forEach(
                    function(alertElement) {

                        if (!alertElement) {
                            return;
                        }


                        setTimeout(
                            function() {

                                if (
                                    typeof bootstrap !== 'undefined' &&
                                    bootstrap.Alert
                                ) {

                                    const alert =
                                        bootstrap.Alert
                                        .getOrCreateInstance(
                                            alertElement
                                        );

                                    alert.close();

                                } else {

                                    alertElement.remove();

                                }

                            },
                            5000
                        );

                    }
                );

            }
        );
    </script>


    @stack('scripts')

</body>

</html>
