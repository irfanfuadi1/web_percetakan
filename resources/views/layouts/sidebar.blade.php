<style>
    /* =========================================================
       SIDEBAR
    ========================================================== */

    .sidebar {
        position: fixed;

        top: 0;
        left: 0;

        width: 250px;
        height: 100vh;

        background: #ffffff;

        border-right: 1px solid #e9e9ef;

        z-index: 1000;

        overflow-y: auto;
        overflow-x: hidden;

        transition:
            width 0.3s ease,
            background-color 0.3s ease,
            border-color 0.3s ease;
    }


    /* =========================================================
       SIDEBAR HEADER
    ========================================================== */

    .sidebar-brand {
        height: 70px;

        display: flex;
        align-items: center;

        padding: 0 15px;

        border-bottom: 1px solid #e9e9ef;

        transition:
            border-color 0.3s ease;
    }


    .sidebar-brand-inner {
        width: 100%;

        display: flex;
        align-items: center;

        justify-content: space-between;

        gap: 10px;
    }


    .sidebar-brand a {
        text-decoration: none;

        color: #6257e8;

        font-size: 22px;

        font-weight: 700;

        white-space: nowrap;

        transition:
            opacity 0.2s ease,
            color 0.3s ease;
    }


    /* =========================================================
       SIDEBAR TOGGLE
    ========================================================== */

    .sidebar-toggle {
        width: 38px;
        height: 38px;

        flex-shrink: 0;

        display: flex;
        align-items: center;
        justify-content: center;

        border: 1px solid #e1e1e7;

        border-radius: 8px;

        background: #f8f8fa;

        color: #555;

        cursor: pointer;

        transition:
            background-color 0.2s ease,
            color 0.2s ease,
            border-color 0.2s ease;
    }


    .sidebar-toggle:hover {
        background: #f1f0ff;

        color: #6257e8;

        border-color: #d8d5ff;
    }


    .sidebar-toggle i {
        font-size: 17px;

        transition:
            transform 0.3s ease;
    }


    /* =========================================================
       SIDEBAR MENU
    ========================================================== */

    .sidebar-menu {
        padding: 20px 15px;
    }


    .sidebar-section-title {
        font-size: 11px;

        font-weight: 700;

        color: #999;

        margin: 20px 10px 8px;

        letter-spacing: 0.5px;

        white-space: nowrap;

        transition:
            opacity 0.2s ease,
            color 0.3s ease;
    }


    .sidebar-link {
        display: flex;

        align-items: center;

        gap: 12px;

        padding: 11px 14px;

        margin-bottom: 4px;

        border-radius: 8px;

        color: #555;

        text-decoration: none;

        font-size: 14px;

        white-space: nowrap;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }


    .sidebar-link i {
        width: 22px;

        min-width: 22px;

        text-align: center;

        font-size: 18px;
    }


    .sidebar-link:hover {
        background: #f3f2ff;

        color: #6257e8;
    }


    .sidebar-link.active {
        background: #6257e8;

        color: #ffffff;
    }


    /* =========================================================
       COLLAPSED SIDEBAR
    ========================================================== */

    body.sidebar-collapsed .sidebar {
        width: 78px;
    }


    body.sidebar-collapsed .sidebar-brand {
        padding: 0 20px;

        justify-content: center;
    }


    body.sidebar-collapsed .sidebar-brand-inner {
        justify-content: center;
    }


    body.sidebar-collapsed .sidebar-brand a {
        display: none;
    }


    body.sidebar-collapsed .sidebar-menu {
        padding: 20px 10px;
    }


    body.sidebar-collapsed .sidebar-section-title {
        opacity: 0;

        height: 10px;

        margin: 12px 0 8px;

        overflow: hidden;
    }


    body.sidebar-collapsed .sidebar-link {
        justify-content: center;

        padding: 11px 10px;

        gap: 0;
    }


    body.sidebar-collapsed .sidebar-link span {
        display: none;
    }


    body.sidebar-collapsed .sidebar-link i {
        margin: 0;

        width: 22px;
    }


    /* =========================================================
       MAIN CONTENT
    ========================================================== */

    .main-content {
        margin-left: 250px;

        min-height: 100vh;

        transition:
            margin-left 0.3s ease;
    }


    body.sidebar-collapsed .main-content {
        margin-left: 78px;
    }


    /* =========================================================
       DARK MODE
    ========================================================== */

    body.dark-mode .sidebar {
        background: #181818;

        border-right-color: #303030;
    }


    body.dark-mode .sidebar-brand {
        border-bottom-color: #303030;
    }


    body.dark-mode .sidebar-brand a {
        color: #8b83ff;
    }


    body.dark-mode .sidebar-toggle {
        background: #252525;

        border-color: #3a3a3a;

        color: #dddddd;
    }


    body.dark-mode .sidebar-toggle:hover {
        background: #333333;

        color: #8b83ff;

        border-color: #4a4a4a;
    }


    body.dark-mode .sidebar-section-title {
        color: #888888;
    }


    body.dark-mode .sidebar-link {
        color: #cccccc;
    }


    body.dark-mode .sidebar-link:hover {
        background: #292929;

        color: #8b83ff;
    }


    body.dark-mode .sidebar-link.active {
        background: #6257e8;

        color: #ffffff;
    }


    /* =========================================================
       SCROLLBAR
    ========================================================== */

    .sidebar::-webkit-scrollbar {
        width: 6px;
    }


    .sidebar::-webkit-scrollbar-thumb {
        background: #d0d0d0;

        border-radius: 10px;
    }


    .sidebar::-webkit-scrollbar-track {
        background: transparent;
    }


    body.dark-mode .sidebar::-webkit-scrollbar-thumb {
        background: #444444;
    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 768px) {

        .sidebar {
            width: 78px;
        }


        .sidebar-brand {
            padding: 0 20px;
        }


        .sidebar-brand-inner {
            justify-content: center;
        }


        .sidebar-brand a {
            display: none;
        }


        .sidebar-menu {
            padding: 20px 10px;
        }


        .sidebar-section-title {
            opacity: 0;

            height: 10px;

            margin: 12px 0 8px;

            overflow: hidden;
        }


        .sidebar-link {
            justify-content: center;

            padding: 11px 10px;

            gap: 0;
        }


        .sidebar-link span {
            display: none;
        }


        .main-content {
            margin-left: 78px;
        }

    }
</style>


<aside class="sidebar">

    {{-- =====================================================
        SIDEBAR HEADER
    ====================================================== --}}

    <div class="sidebar-brand">

        <div class="sidebar-brand-inner">

            {{-- BRAND --}}
            <a href="{{ route('dashboard') }}">
                Gemiprint
            </a>


            {{-- TOGGLE --}}
            <button type="button" class="sidebar-toggle" id="sidebarToggle" title="Tutup Sidebar"
                aria-label="Tutup Sidebar">

                <i class="bi bi-arrow-left" id="sidebarToggleIcon"></i>

            </button>

        </div>

    </div>


    {{-- =====================================================
        SIDEBAR MENU
    ====================================================== --}}

    <div class="sidebar-menu">


        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
            title="Dashboard">

            <i class="bi bi-grid"></i>

            <span>
                Dashboard
            </span>

        </a>


        {{-- =================================================
            PRODUKSI
        ================================================== --}}

        <div class="sidebar-section-title">
            PRODUKSI
        </div>


        <a href="{{ route('production-queues.index') }}"
            class="sidebar-link {{ request()->routeIs('production-queues.*') ? 'active' : '' }}"
            title="Antrian Produksi">

            <i class="bi bi-list-check"></i>

            <span>
                Antrian Produksi
            </span>

        </a>


        {{-- =================================================
            TRANSAKSI
        ================================================== --}}

        <div class="sidebar-section-title">
            TRANSAKSI
        </div>


        <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}"
            title="Pesanan">

            <i class="bi bi-cart3"></i>

            <span>
                Pesanan
            </span>

        </a>


        <a href="{{ route('invoice-project.index') }}"
            class="sidebar-link {{ request()->routeIs('invoice-project.*') ? 'active' : '' }}" title="Invoice Project">

            <i class="bi bi-receipt"></i>

            <span>
                Invoice Project
            </span>

        </a>


        <a href="{{ route('receivables.index') }}"
            class="sidebar-link {{ request()->routeIs('receivables.*') ? 'active' : '' }}" title="Manajemen Piutang">

            <i class="bi bi-wallet2"></i>

            <span>
                Manajemen Piutang
            </span>

        </a>


        <a href="{{ route('purchases.index') }}"
            class="sidebar-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}" title="Pembelian">

            <i class="bi bi-bag-check"></i>

            <span>
                Pembelian
            </span>

        </a>


        <a href="{{ route('expenses.index') }}"
            class="sidebar-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}" title="Pengeluaran">

            <i class="bi bi-cash-stack"></i>

            <span>
                Pengeluaran
            </span>

        </a>


        {{-- =================================================
            MASTER DATA
        ================================================== --}}

        <div class="sidebar-section-title">
            MASTER DATA
        </div>


        <a href="{{ route('categories.index') }}"
            class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" title="Kategori">

            <i class="bi bi-tags"></i>

            <span>
                Kategori
            </span>

        </a>


        <a href="{{ route('products.index') }}"
            class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}" title="Master Item">

            <i class="bi bi-box-seam"></i>

            <span>
                Master Item
            </span>

        </a>


        <a href="{{ route('customers.index') }}"
            class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}" title="Pelanggan">

            <i class="bi bi-people"></i>

            <span>
                Pelanggan
            </span>

        </a>


        <a href="{{ route('suppliers.index') }}"
            class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}" title="Supplier">

            <i class="bi bi-truck"></i>

            <span>
                Supplier
            </span>

        </a>


        <a href="{{ route('cash-accounts.index') }}"
            class="sidebar-link {{ request()->routeIs('cash-accounts.*') ? 'active' : '' }}" title="Kas / Akun">

            <i class="bi bi-bank"></i>

            <span>
                Kas / Akun
            </span>

        </a>


        {{-- =================================================
            LAPORAN
        ================================================== --}}

        <div class="sidebar-section-title">
            LAPORAN
        </div>


        <a href="{{ route('reports.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.index') ? 'active' : '' }}" title="Pusat Laporan">

            <i class="bi bi-bar-chart"></i>

            <span>
                Pusat Laporan
            </span>

        </a>


        <a href="{{ route('reports.sales.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.sales.*') ? 'active' : '' }}" title="Laporan Penjualan">

            <i class="bi bi-graph-up"></i>

            <span>
                Laporan Penjualan
            </span>

        </a>


        <a href="{{ route('reports.purchases.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.purchases.*') ? 'active' : '' }}"
            title="Laporan Pembelian">

            <i class="bi bi-graph-down"></i>

            <span>
                Laporan Pembelian
            </span>

        </a>


        <a href="{{ route('reports.cash-flow.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.cash-flow.*') ? 'active' : '' }}"
            title="Laporan Arus Kas">

            <i class="bi bi-arrow-left-right"></i>

            <span>
                Laporan Arus Kas
            </span>

        </a>


        <a href="{{ route('reports.profit-loss.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.profit-loss.*') ? 'active' : '' }}"
            title="Laporan Laba Rugi">

            <i class="bi bi-pie-chart"></i>

            <span>
                Laporan Laba Rugi
            </span>

        </a>


        <a href="{{ route('reports.stock.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.stock.*') ? 'active' : '' }}" title="Laporan Stok">

            <i class="bi bi-boxes"></i>

            <span>
                Laporan Stok
            </span>

        </a>


        <a href="{{ route('reports.receivables.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.receivables.*') ? 'active' : '' }}"
            title="Laporan Piutang">

            <i class="bi bi-wallet"></i>

            <span>
                Laporan Piutang
            </span>

        </a>


        <a href="{{ route('reports.payables.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.payables.*') ? 'active' : '' }}" title="Laporan Hutang">

            <i class="bi bi-credit-card"></i>

            <span>
                Laporan Hutang
            </span>

        </a>


        {{-- =================================================
            SYSTEM
        ================================================== --}}

        <div class="sidebar-section-title">
            SYSTEM
        </div>


        <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}"
            title="Manajemen User">

            <i class="bi bi-person-gear"></i>

            <span>
                Manajemen User
            </span>

        </a>


        <a href="{{ route('activity-logs.index') }}"
            class="sidebar-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}"
            title="Riwayat Aktivitas">

            <i class="bi bi-clock-history"></i>

            <span>
                Riwayat Aktivitas
            </span>

        </a>

    </div>

</aside>


<script>
    document.addEventListener('DOMContentLoaded', function () {

        const sidebarToggle =
            document.getElementById('sidebarToggle');

        const sidebarToggleIcon =
            document.getElementById('sidebarToggleIcon');


        if (!sidebarToggle) {
            return;
        }


        /* =====================================================
           LOAD SIDEBAR STATE
        ====================================================== */

        const sidebarState =
            localStorage.getItem('sidebar');


        if (sidebarState === 'collapsed') {

            document.body.classList.add(
                'sidebar-collapsed'
            );

            updateSidebarButton(true);

        } else {

            document.body.classList.remove(
                'sidebar-collapsed'
            );

            updateSidebarButton(false);

        }


        /* =====================================================
           TOGGLE SIDEBAR
        ====================================================== */

        sidebarToggle.addEventListener('click', function () {

            const collapsed =
                document.body.classList.toggle(
                    'sidebar-collapsed'
                );


            localStorage.setItem(
                'sidebar',
                collapsed ? 'collapsed' : 'expanded'
            );


            updateSidebarButton(collapsed);

        });


        /* =====================================================
           UPDATE BUTTON
        ====================================================== */

        function updateSidebarButton(collapsed) {

            if (collapsed) {

                /*
                 * SIDEBAR MENGECIL
                 * Tombol = ☰
                 */

                sidebarToggleIcon.classList.remove(
                    'bi-arrow-left'
                );

                sidebarToggleIcon.classList.add(
                    'bi-list'
                );


                sidebarToggle.setAttribute(
                    'title',
                    'Buka Sidebar'
                );


                sidebarToggle.setAttribute(
                    'aria-label',
                    'Buka Sidebar'
                );

            } else {

                /*
                 * SIDEBAR TERBUKA
                 * Tombol = ←
                 */

                sidebarToggleIcon.classList.remove(
                    'bi-list'
                );

                sidebarToggleIcon.classList.add(
                    'bi-arrow-left'
                );


                sidebarToggle.setAttribute(
                    'title',
                    'Tutup Sidebar'
                );


                sidebarToggle.setAttribute(
                    'aria-label',
                    'Tutup Sidebar'
                );

            }

        }

    });
</script>
