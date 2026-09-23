<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Kasir Percetakan')
    </title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>
        body {
            background-color: #f7f8fc;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .app-wrapper {
            min-height: 100vh;
        }

        .main-content {
            margin-left: 250px;
            min-height: 100vh;
        }

        .content-wrapper {
            padding: 25px 30px;
        }

        /* =========================
           DARK MODE
        ========================= */

        body.dark-mode {
            background-color: #121212;
            color: #e9ecef;
        }

        body.dark-mode .main-content {
            background-color: #121212;
        }

        body.dark-mode .content-wrapper {
            color: #e9ecef;
        }

        body.dark-mode .card {
            background-color: #1e1e1e;
            color: #e9ecef;
            border-color: #333;
        }

        body.dark-mode .table {
            color: #e9ecef;
        }

        body.dark-mode .table thead {
            background-color: #2a2a2a;
            color: #fff;
        }

        body.dark-mode .table tbody tr {
            border-color: #333;
        }

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
            border-color: #666;
        }

        body.dark-mode .modal-content {
            background-color: #1e1e1e;
            color: #fff;
        }

        body.dark-mode .modal-header,
        body.dark-mode .modal-footer {
            border-color: #333;
        }

        body.dark-mode .text-muted {
            color: #aaa !important;
        }

        body.dark-mode .dropdown-menu {
            background-color: #1e1e1e;
            border-color: #333;
        }

        body.dark-mode .dropdown-item {
            color: #fff;
        }

        body.dark-mode .dropdown-item:hover {
            background-color: #333;
        }

        /* =========================
           NAVBAR THEME BUTTON
        ========================= */

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
            transition: all 0.3s ease;
        }

        .btn-navbar:hover {
            background-color: rgba(0, 0, 0, 0.08);
        }

        body.dark-mode .btn-navbar:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .btn-navbar i {
            font-size: 18px;
        }

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

        @include('layouts.sidebar')

        <div class="main-content">

            @include('layouts.navbar')

            <main class="content-wrapper">
                @yield('content')
            </main>

        </div>

    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Dark / Light Mode -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = document.getElementById('themeIcon');

            // Ambil tema yang tersimpan
            const savedTheme = localStorage.getItem('theme');

            // Terapkan tema saat halaman dibuka
            if (savedTheme === 'dark') {
                document.body.classList.add('dark-mode');
                themeIcon.classList.remove('bi-moon-fill');
                themeIcon.classList.add('bi-sun-fill');
            }

            // Tombol Dark / Light
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {

                    document.body.classList.toggle('dark-mode');

                    const isDarkMode =
                        document.body.classList.contains('dark-mode');

                    if (isDarkMode) {

                        // Simpan dark mode
                        localStorage.setItem('theme', 'dark');

                        // Ubah icon menjadi matahari
                        themeIcon.classList.remove('bi-moon-fill');
                        themeIcon.classList.add('bi-sun-fill');

                    } else {

                        // Simpan light mode
                        localStorage.setItem('theme', 'light');

                        // Ubah icon menjadi bulan
                        themeIcon.classList.remove('bi-sun-fill');
                        themeIcon.classList.add('bi-moon-fill');
                    }
                });
            }

        });
    </script>

    @stack('scripts')

</body>

</html>
