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
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .navbar-user {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #444;
        font-size: 13px;
    }

    .user-avatar {
        width: 34px;
        height: 34px;
        background: #665ce6;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 600;
    }

    /* Dark Mode Navbar */
    body.dark-mode .top-navbar {
        background: #1e1e1e;
        border-bottom-color: #333;
    }

    body.dark-mode .navbar-user {
        color: #e9e9e9;
    }
</style>

<header class="top-navbar">

    <!-- Dark / Light -->
    <button type="button" class="btn btn-navbar" id="themeToggle" title="Ubah Tema">
        <i class="bi bi-moon-fill" id="themeIcon"></i>
    </button>

    <!-- User -->
    <div class="navbar-user">

        <div class="user-avatar">
            A
        </div>

        <span>Admin</span>

        <i class="bi bi-chevron-down"></i>

    </div>

</header>
