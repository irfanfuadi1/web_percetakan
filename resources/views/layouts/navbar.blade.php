<style>
    /* =========================================================
       TOP NAVBAR
    ========================================================== */

    .top-navbar {
        height: 70px;

        background: #ffffff;

        border-bottom: 1px solid #e9e9ef;

        display: flex;
        align-items: center;
        justify-content: flex-end;

        padding: 0 30px;

        gap: 15px;

        transition:
            background-color 0.3s ease,
            border-color 0.3s ease,
            color 0.3s ease;
    }


    /* =========================================================
       THEME BUTTON
    ========================================================== */

    .btn-navbar {
        width: 38px;
        height: 38px;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 0;
        border-radius: 8px;

        color: #555;

        background: transparent;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }


    .btn-navbar:hover {
        background: #f1f1f7;
        color: #6257e8;
    }


    .btn-navbar i {
        font-size: 16px;

        transition:
            color 0.2s ease,
            transform 0.2s ease;
    }


    /* =========================================================
       USER AREA
    ========================================================== */

    .navbar-user {
        position: relative;

        display: flex;
        align-items: center;

        gap: 10px;

        color: #444;

        font-size: 13px;

        cursor: pointer;

        padding: 5px 8px;

        border-radius: 8px;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }


    .navbar-user:hover {
        background: #f6f6fa;
    }


    /* =========================================================
       USER AVATAR
    ========================================================== */

    .user-avatar {
        width: 34px;
        height: 34px;

        background: #665ce6;

        color: #ffffff;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 600;
        font-size: 14px;

        text-transform: uppercase;

        flex-shrink: 0;
    }


    /* =========================================================
       USER INFORMATION
    ========================================================== */

    .navbar-user-info {
        display: flex;
        flex-direction: column;

        line-height: 1.2;
    }


    .navbar-user-name {
        font-weight: 600;

        color: #333333;

        transition: color 0.2s ease;
    }


    .navbar-user-role {
        font-size: 11px;

        color: #888888;

        margin-top: 2px;

        text-transform: capitalize;

        transition: color 0.2s ease;
    }


    /* =========================================================
       CHEVRON
    ========================================================== */

    .navbar-user>.bi-chevron-down {
        font-size: 11px;

        color: #777777;

        transition:
            transform 0.2s ease,
            color 0.2s ease;
    }


    /* Ketika dropdown terbuka */
    .dropdown.show .navbar-user>.bi-chevron-down {
        transform: rotate(180deg);
    }


    /* =========================================================
       USER DROPDOWN
    ========================================================== */

    .navbar-user-menu {
        min-width: 210px;

        padding: 8px;

        margin-top: 8px !important;

        background: #ffffff;

        border: 1px solid #e9e9ef;

        border-radius: 10px;

        box-shadow:
            0 8px 25px rgba(0, 0, 0, 0.08);

        transition:
            background-color 0.3s ease,
            border-color 0.3s ease,
            box-shadow 0.3s ease;
    }


    /* =========================================================
       DROPDOWN USER INFO
    ========================================================== */

    .navbar-user-menu .user-menu-name {
        color: #333333;

        font-size: 15px;

        font-weight: 600;

        transition: color 0.2s ease;
    }


    .navbar-user-menu .user-menu-username {
        color: #888888;

        font-size: 13px;

        transition: color 0.2s ease;
    }


    /* =========================================================
       DROPDOWN ITEM
    ========================================================== */

    .navbar-user-menu .dropdown-item {
        border-radius: 7px;

        padding: 9px 10px;

        font-size: 13px;

        color: #444444;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }


    .navbar-user-menu .dropdown-item:hover {
        background: #f5f5fa;

        color: #333333;
    }


    .navbar-user-menu .dropdown-item.text-danger {
        color: #dc3545 !important;
    }


    .navbar-user-menu .dropdown-item.text-danger:hover {
        background: #fff1f2;

        color: #dc3545 !important;
    }


    /* =========================================================
       DROPDOWN DIVIDER
    ========================================================== */

    .navbar-user-menu .dropdown-divider {
        margin: 6px 0;

        border-top-color: #e9e9ef;

        opacity: 1;
    }


    /* =========================================================
       DARK MODE - NAVBAR
    ========================================================== */

    body.dark-mode .top-navbar {
        background: #1e1e1e;

        border-bottom-color: #333333;
    }


    /* =========================================================
       DARK MODE - THEME BUTTON
    ========================================================== */

    body.dark-mode .btn-navbar {
        color: #dddddd;
    }


    body.dark-mode .btn-navbar:hover {
        background: #2b2b2b;

        color: #8b83ff;
    }


    /* =========================================================
       DARK MODE - USER
    ========================================================== */

    body.dark-mode .navbar-user {
        color: #e9e9e9;
    }


    body.dark-mode .navbar-user:hover {
        background: #292929;
    }


    body.dark-mode .navbar-user-name {
        color: #f1f1f1;
    }


    body.dark-mode .navbar-user-role {
        color: #aaaaaa;
    }


    body.dark-mode .navbar-user>.bi-chevron-down {
        color: #aaaaaa;
    }


    /* =========================================================
       DARK MODE - DROPDOWN
    ========================================================== */

    body.dark-mode .navbar-user-menu {
        background: #252525;

        border-color: #3a3a3a;

        box-shadow:
            0 10px 30px rgba(0, 0, 0, 0.35);
    }


    /* Nama Mikel */
    body.dark-mode .navbar-user-menu .user-menu-name {
        color: #f1f1f1;
    }


    /* @admin */
    body.dark-mode .navbar-user-menu .user-menu-username {
        color: #aaaaaa;
    }


    /* Semua dropdown item */
    body.dark-mode .navbar-user-menu .dropdown-item {
        color: #e9e9e9;
    }


    body.dark-mode .navbar-user-menu .dropdown-item:hover {
        background: #333333;

        color: #ffffff;
    }


    /* Logout */
    body.dark-mode .navbar-user-menu .dropdown-item.text-danger {
        color: #ff5c6c !important;
    }


    body.dark-mode .navbar-user-menu .dropdown-item.text-danger:hover {
        background: #3a2528;

        color: #ff6b78 !important;
    }


    /* Divider */
    body.dark-mode .navbar-user-menu .dropdown-divider {
        border-top-color: #3a3a3a;
    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 576px) {

        .top-navbar {
            padding: 0 15px;
        }


        .navbar-user-info {
            display: none;
        }

    }
</style>


<header class="top-navbar">

    {{-- =====================================================
        DARK / LIGHT MODE
        JS THEME TETAP DIATUR OLEH app.blade.php
    ====================================================== --}}

    <button type="button" class="btn btn-navbar" id="themeToggle" title="Ubah Tema" aria-label="Ubah Tema">
        <i class="bi bi-moon-fill" id="themeIcon"></i>
    </button>


    {{-- =====================================================
        USER
    ====================================================== --}}

    @auth

        <div class="dropdown">

            <div class="navbar-user" data-bs-toggle="dropdown" aria-expanded="false">

                {{-- AVATAR --}}
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name ?: Auth::user()->username, 0, 1)) }}
                </div>


                {{-- USER INFO --}}
                <div class="navbar-user-info">

                    <span class="navbar-user-name">
                        {{ Auth::user()->name ?: Auth::user()->username }}
                    </span>

                    <span class="navbar-user-role">
                        {{ ucfirst(Auth::user()->role) }}
                    </span>

                </div>


                {{-- CHEVRON --}}
                <i class="bi bi-chevron-down"></i>

            </div>


            {{-- =================================================
                USER DROPDOWN
            ================================================== --}}

            <ul class="dropdown-menu dropdown-menu-end navbar-user-menu">

                {{-- INFORMASI USER --}}
                <li>

                    <div class="px-2 py-2">

                        <div class="user-menu-name">
                            {{ Auth::user()->name ?: Auth::user()->username }}
                        </div>

                        <div class="user-menu-username mt-1">
                            {{ '@' . Auth::user()->username }}
                        </div>

                    </div>

                </li>


                {{-- DIVIDER --}}
                <li>
                    <hr class="dropdown-divider">
                </li>


                {{-- PENGATURAN --}}
                <li>

                    <a href="{{ route('settings.index') }}" class="dropdown-item">

                        <i class="bi bi-gear me-2"></i>

                        Pengaturan

                    </a>

                </li>


                {{-- DIVIDER --}}
                <li>

                    <hr class="dropdown-divider">

                </li>


                {{-- LOGOUT --}}
                <li>

                    <form action="{{ route('logout') }}" method="POST" onsubmit="return confirmLogout();">

                        @csrf

                        <button type="submit" class="dropdown-item text-danger">

                            <i class="bi bi-box-arrow-right me-2"></i>

                            Logout

                        </button>

                    </form>

                </li>

            </ul>

        </div>

    @endauth

</header>


<script>
    function confirmLogout() {

        return confirm(
            'Apakah anda yakin ingin logout dari aplikasi?'
        );

    }
</script>
