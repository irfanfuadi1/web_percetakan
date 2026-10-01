<style>
    .top-navbar {
        height: 70px;
        background: #fff;
        border-bottom: 1px solid #e9e9ef;

        display: flex;
        align-items: center;
        justify-content: flex-end;

        padding: 0 30px;
        gap: 15px;

        transition:
            background-color 0.3s ease,
            border-color 0.3s ease;
    }


    /* =========================================================
       THEME BUTTON
       ========================================================= */

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

        transition: all 0.2s ease;
    }


    .btn-navbar:hover {
        background: #f1f1f7;
        color: #6257e8;
    }


    .btn-navbar i {
        font-size: 16px;
    }


    /* =========================================================
       USER
       ========================================================= */

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

        transition: background-color 0.2s ease;
    }


    .navbar-user:hover {
        background: #f6f6fa;
    }


    .user-avatar {
        width: 34px;
        height: 34px;

        background: #665ce6;
        color: #fff;

        border-radius: 50%;

        display: flex;
        align-items: center;
        justify-content: center;

        font-weight: 600;
        font-size: 14px;

        text-transform: uppercase;
    }


    .navbar-user-info {
        display: flex;
        flex-direction: column;

        line-height: 1.2;
    }


    .navbar-user-name {
        font-weight: 600;
        color: #333;
    }


    .navbar-user-role {
        font-size: 11px;
        color: #888;

        margin-top: 2px;

        text-transform: capitalize;
    }


    .navbar-user>.bi-chevron-down {
        font-size: 11px;
        color: #777;

        transition: transform 0.2s ease;
    }


    .navbar-user.show>.bi-chevron-down {
        transform: rotate(180deg);
    }


    /* =========================================================
       USER DROPDOWN
       ========================================================= */

    .navbar-user-menu {
        min-width: 210px;

        padding: 8px;

        border: 1px solid #e9e9ef;

        border-radius: 10px;

        box-shadow:
            0 8px 25px rgba(0, 0, 0, 0.08);
    }


    .navbar-user-menu .dropdown-item {
        border-radius: 7px;

        padding: 9px 10px;

        font-size: 13px;
    }


    .navbar-user-menu .dropdown-item:hover {
        background: #f5f5fa;
    }


    .navbar-user-menu .dropdown-divider {
        margin: 6px 0;
    }


    /* =========================================================
       DARK MODE
       ========================================================= */

    body.dark-mode .top-navbar {
        background: #1e1e1e;
        border-bottom-color: #333;
    }


    body.dark-mode .btn-navbar {
        color: #ddd;
    }


    body.dark-mode .btn-navbar:hover {
        background: #2b2b2b;
        color: #8b83ff;
    }


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
        color: #aaa;
    }


    body.dark-mode .navbar-user>.bi-chevron-down {
        color: #aaa;
    }


    body.dark-mode .navbar-user-menu {
        background: #252525;
        border-color: #3a3a3a;
    }


    body.dark-mode .navbar-user-menu .dropdown-item {
        color: #e9e9e9;
    }


    body.dark-mode .navbar-user-menu .dropdown-item:hover {
        background: #333;
    }


    body.dark-mode .navbar-user-menu .dropdown-divider {
        border-color: #3a3a3a;
    }


    /* =========================================================
       MOBILE
       ========================================================= */

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


                <i class="bi bi-chevron-down"></i>

            </div>


            {{-- USER MENU --}}
            <ul class="dropdown-menu dropdown-menu-end navbar-user-menu">


                {{-- INFORMASI USER --}}
                <li>

                    <div class="px-2 py-2">

                        <div class="fw-semibold">

                            {{ Auth::user()->name ?: Auth::user()->username }}

                        </div>

                        <small class="text-muted">

                            {{ '@' . Auth::user()->username }}

                        </small>

                    </div>

                </li>


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
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            const themeToggle =
                document.getElementById('themeToggle');

            const themeIcon =
                document.getElementById('themeIcon');


            if (!themeToggle || !themeIcon) {
                return;
            }


            /*
            |--------------------------------------------------------------------------
            | LOAD THEME
            |--------------------------------------------------------------------------
            */

            const savedTheme =
                localStorage.getItem('theme');


            if (savedTheme === 'dark') {

                document.body.classList.add('dark-mode');

                themeIcon.classList.remove('bi-moon-fill');

                themeIcon.classList.add('bi-sun-fill');

            }


            /*
            |--------------------------------------------------------------------------
            | TOGGLE THEME
            |--------------------------------------------------------------------------
            */

            themeToggle.addEventListener(
                'click',
                function() {

                    document.body.classList.toggle('dark-mode');


                    const isDark =
                        document.body.classList.contains(
                            'dark-mode'
                        );


                    if (isDark) {

                        localStorage.setItem(
                            'theme',
                            'dark'
                        );

                        themeIcon.classList.remove(
                            'bi-moon-fill'
                        );

                        themeIcon.classList.add(
                            'bi-sun-fill'
                        );

                    } else {

                        localStorage.setItem(
                            'theme',
                            'light'
                        );

                        themeIcon.classList.remove(
                            'bi-sun-fill'
                        );

                        themeIcon.classList.add(
                            'bi-moon-fill'
                        );

                    }

                }
            );

        }
    );
</script>

<script>
    function confirmLogout() {

        return confirm(
            'Apakah anda yakin ingin logout dari aplikasi?'
        );

    }
</script>