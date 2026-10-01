<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Login - Gemiprint</title>


    {{-- Bootstrap --}}
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >


    {{-- Bootstrap Icons --}}
    <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    >


    <style>

        * {
            box-sizing: border-box;
        }


        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #f5f7fb;

            font-family:
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                Roboto,
                Arial,
                sans-serif;
        }


        /* =====================================================
           LOGIN CARD
        ====================================================== */

        .login-card {
            width: 100%;
            max-width: 380px;

            background: #ffffff;

            border-radius: 14px;

            padding: 28px 28px 30px;

            box-shadow:
                0 2px 6px rgba(0, 0, 0, 0.08),
                0 10px 25px rgba(0, 0, 0, 0.05);
        }


        /* =====================================================
           BRAND
        ====================================================== */

        .brand {
            text-align: center;

            font-size: 25px;

            font-weight: 700;

            color: #6257e8;

            margin-bottom: 30px;
        }


        /* =====================================================
           TITLE
        ====================================================== */

        .login-title {
            text-align: center;

            font-size: 20px;

            font-weight: 500;

            color: #202124;

            margin-bottom: 25px;
        }


        /* =====================================================
           FORM
        ====================================================== */

        .form-label {
            font-size: 14px;

            font-weight: 500;

            color: #333;

            margin-bottom: 7px;
        }


        .form-control {
            height: 44px;

            border: 1px solid #dce2ef;

            border-radius: 7px;

            background: #eef3fd;

            padding: 10px 13px;

            font-size: 14px;
        }


        .form-control:focus {
            background: #ffffff;

            border-color: #6257e8;

            box-shadow:
                0 0 0 3px rgba(98, 87, 232, 0.12);
        }


        /* =====================================================
           PASSWORD
        ====================================================== */

        .password-wrapper {
            position: relative;
        }


        .password-wrapper .form-control {
            padding-right: 42px;
        }


        .toggle-password {
            position: absolute;

            top: 50%;
            right: 12px;

            transform: translateY(-50%);

            border: 0;

            background: transparent;

            color: #777;

            padding: 0;

            cursor: pointer;

            z-index: 5;
        }


        .toggle-password:hover {
            color: #6257e8;
        }


        /* =====================================================
           LOGIN BUTTON
        ====================================================== */

        .login-button {
            width: 100%;

            height: 44px;

            border: 0;

            border-radius: 7px;

            background: #6257e8;

            color: #ffffff;

            font-size: 14px;

            font-weight: 500;

            transition: 0.2s ease;
        }


        .login-button:hover {
            background: #5146d8;
        }


        .login-button:active {
            transform: translateY(1px);
        }


        /* =====================================================
           ALERT
        ====================================================== */

        .login-alert {
            font-size: 13px;

            border-radius: 7px;

            margin-bottom: 20px;
        }


        .login-alert i {
            font-size: 14px;
        }


        .invalid-feedback {
            font-size: 12px;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 480px) {

            .login-card {
                margin: 15px;

                padding: 25px 22px;
            }

        }

    </style>

</head>


<body>


    <div class="login-card">


        {{-- =====================================================
            BRAND
        ====================================================== --}}

        <div class="brand">
            Gemiprint
        </div>


        {{-- =====================================================
            TITLE
        ====================================================== --}}

        <div class="login-title">
            Sign In
        </div>


        {{-- =====================================================
            LOGIN BERHASIL / LOGOUT BERHASIL
        ====================================================== --}}

        @if (session('success'))

            <div
                id="successAlert"
                class="alert alert-success login-alert alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-check-circle-fill me-1"></i>

                {{ session('success') }}


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>

            </div>

        @endif


        {{-- =====================================================
            LOGIN GAGAL
        ====================================================== --}}

        @if (session('error'))

            <div
                id="errorAlert"
                class="alert alert-danger login-alert alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-exclamation-circle-fill me-1"></i>

                {{ session('error') }}


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>

            </div>

        @endif


        {{-- =====================================================
            VALIDATION ERROR
        ====================================================== --}}

        @if ($errors->any())

            <div
                id="validationAlert"
                class="alert alert-danger login-alert alert-dismissible fade show"
                role="alert"
            >

                <i class="bi bi-exclamation-triangle-fill me-1"></i>

                {{ $errors->first() }}


                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="alert"
                    aria-label="Close"
                ></button>

            </div>

        @endif


        {{-- =====================================================
            LOGIN FORM
        ====================================================== --}}

        <form
            action="{{ route('login.process') }}"
            method="POST"
        >

            @csrf


            {{-- =================================================
                USERNAME
            ================================================== --}}

            <div class="mb-3">

                <label
                    for="username"
                    class="form-label"
                >
                    Username
                </label>


                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control @error('username') is-invalid @enderror"
                    value="{{ old('username') }}"
                    placeholder="Username"
                    autocomplete="username"
                    autofocus
                    required
                >


                @error('username')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                PASSWORD
            ================================================== --}}

            <div class="mb-3">

                <label
                    for="password"
                    class="form-label"
                >
                    Password
                </label>


                <div class="password-wrapper">

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control @error('password') is-invalid @enderror"
                        placeholder="Password"
                        autocomplete="current-password"
                        required
                    >


                    <button
                        type="button"
                        class="toggle-password"
                        id="togglePassword"
                        aria-label="Tampilkan password"
                    >

                        <i class="bi bi-eye"></i>

                    </button>

                </div>


                @error('password')

                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>

                @enderror

            </div>


            {{-- =================================================
                REMEMBER ME
            ================================================== --}}

            <div class="form-check mb-3">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember"
                    value="1"
                    {{ old('remember') ? 'checked' : '' }}
                >


                <label
                    class="form-check-label small text-muted"
                    for="remember"
                >
                    Ingat saya
                </label>

            </div>


            {{-- =================================================
                LOGIN BUTTON
            ================================================== --}}

            <button
                type="submit"
                class="login-button"
            >

                Login

            </button>

        </form>

    </div>


    {{-- =========================================================
        BOOTSTRAP JS
    ========================================================== --}}

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>


    <script>

        document.addEventListener(
            'DOMContentLoaded',
            function () {


                /* =================================================
                   TOGGLE PASSWORD
                ================================================== */

                const password =
                    document.getElementById('password');

                const toggle =
                    document.getElementById('togglePassword');


                if (password && toggle) {

                    toggle.addEventListener(
                        'click',
                        function () {

                            const icon =
                                toggle.querySelector('i');


                            if (
                                password.type === 'password'
                            ) {

                                password.type = 'text';

                                icon.classList.remove(
                                    'bi-eye'
                                );

                                icon.classList.add(
                                    'bi-eye-slash'
                                );

                                toggle.setAttribute(
                                    'aria-label',
                                    'Sembunyikan password'
                                );

                            } else {

                                password.type = 'password';

                                icon.classList.remove(
                                    'bi-eye-slash'
                                );

                                icon.classList.add(
                                    'bi-eye'
                                );

                                toggle.setAttribute(
                                    'aria-label',
                                    'Tampilkan password'
                                );

                            }

                        }
                    );

                }


                /* =================================================
                   AUTO CLOSE NOTIFICATION - 5000 MS
                ================================================== */

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
                    function (alertElement) {

                        if (!alertElement) {
                            return;
                        }


                        setTimeout(
                            function () {

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


</body>

</html>