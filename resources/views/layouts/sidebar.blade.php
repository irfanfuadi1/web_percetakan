<style>
    /* =========================
       SIDEBAR LIGHT MODE
    ========================= */
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
        transition:
            background-color 0.3s ease,
            border-color 0.3s ease,
            color 0.3s ease;
    }

    .sidebar-brand {
        height: 70px;
        display: flex;
        align-items: center;
        padding: 0 25px;
        border-bottom: 1px solid #e9e9ef;
        transition: border-color 0.3s ease;
    }

    .sidebar-brand a {
        text-decoration: none;
        color: #6257e8;
        font-size: 22px;
        font-weight: 700;
    }

    .sidebar-menu {
        padding: 20px 15px;
    }

    .sidebar-section-title {
        font-size: 11px;
        font-weight: 700;
        color: #999;
        margin: 20px 10px 8px;
        letter-spacing: 0.5px;
        transition: color 0.3s ease;
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
        transition:
            background-color 0.3s ease,
            color 0.3s ease;
    }

    .sidebar-link i {
        font-size: 18px;
        width: 22px;
        text-align: center;
    }

    .sidebar-link:hover {
        background: #f3f2ff;
        color: #6257e8;
    }

    .sidebar-link.active {
        background: #6257e8;
        color: #ffffff;
    }

    /* =========================
       SIDEBAR DARK MODE
    ========================= */
    body.dark-mode .sidebar {
        background: #181818;
        border-right-color: #303030;
        color: #e9e9e9;
    }

    body.dark-mode .sidebar-brand {
        border-bottom-color: #303030;
    }

    body.dark-mode .sidebar-brand a {
        color: #8b82ff;
    }

    body.dark-mode .sidebar-section-title {
        color: #888;
    }

    body.dark-mode .sidebar-link {
        color: #cfcfcf;
    }

    body.dark-mode .sidebar-link i {
        color: #cfcfcf;
    }

    body.dark-mode .sidebar-link:hover {
        background: #292929;
        color: #8b82ff;
    }

    body.dark-mode .sidebar-link:hover i {
        color: #8b82ff;
    }

    body.dark-mode .sidebar-link.active {
        background: #6257e8;
        color: #ffffff;
    }

    body.dark-mode .sidebar-link.active i {
        color: #ffffff;
    }

    /* =========================
       SCROLLBAR
    ========================= */
    .sidebar::-webkit-scrollbar {
        width: 6px;
    }

    .sidebar::-webkit-scrollbar-thumb {
        background: #d0d0d0;
        border-radius: 10px;
    }

    body.dark-mode .sidebar::-webkit-scrollbar-thumb {
        background: #444;
    }

    body.dark-mode .sidebar::-webkit-scrollbar-track {
        background: #181818;
    }
</style>


<aside class="sidebar">

    <!-- BRAND -->
    <div class="sidebar-brand">
        <a href="{{ route('dashboard') }}">
            Gemiprint
        </a>
    </div>

    <!-- MENU -->
    <div class="sidebar-menu">

        <!-- DASHBOARD -->
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="bi bi-grid"></i>
            <span>Dashboard</span>
        </a>


        <!-- ================= PRODUKSI ================= -->
        <div class="sidebar-section-title">
            PRODUKSI
        </div>

        <a href="{{ route('production-queues.index') }}"
            class="sidebar-link {{ request()->routeIs('production-queues.*') ? 'active' : '' }}">
            <i class="bi bi-list-check"></i>
            <span>Antrian Produksi</span>
        </a>


        <!-- ================= TRANSAKSI ================= -->
        <div class="sidebar-section-title">
            TRANSAKSI
        </div>

        <a href="{{ route('orders.index') }}" class="sidebar-link {{ request()->routeIs('orders.*') ? 'active' : '' }}">
            <i class="bi bi-cart3"></i>
            <span>Pesanan</span>
        </a>

        <a href="{{ route('invoice-project.index') }}"
            class="sidebar-link {{ request()->routeIs('invoice-project.*') ? 'active' : '' }}">
            <i class="bi bi-receipt"></i>
            <span>Invoice Project</span>
        </a>

        <a href="{{ route('receivables.index') }}"
            class="sidebar-link {{ request()->routeIs('receivables.*') ? 'active' : '' }}">
            <i class="bi bi-wallet2"></i>
            <span>Manajemen Piutang</span>
        </a>

        <a href="{{ route('purchases.index') }}"
            class="sidebar-link {{ request()->routeIs('purchases.*') ? 'active' : '' }}">
            <i class="bi bi-bag-check"></i>
            <span>Pembelian</span>
        </a>

        <a href="{{ route('expenses.index') }}"
            class="sidebar-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">
            <i class="bi bi-cash-stack"></i>
            <span>Pengeluaran</span>
        </a>


        <!-- ================= MASTER DATA ================= -->
        <div class="sidebar-section-title">
            MASTER DATA
        </div>

        <a href="{{ route('categories.index') }}"
            class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
            <i class="bi bi-tags"></i>
            <span>Kategori</span>
        </a>

        <a href="{{ route('products.index') }}"
            class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">
            <i class="bi bi-box-seam"></i>
            <span>Master Item</span>
        </a>

        <a href="{{ route('customers.index') }}"
            class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i>
            <span>Pelanggan</span>
        </a>

        <a href="{{ route('suppliers.index') }}"
            class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">
            <i class="bi bi-truck"></i>
            <span>Supplier</span>
        </a>

        <a href="{{ route('cash-accounts.index') }}"
            class="sidebar-link {{ request()->routeIs('cash-accounts.*') ? 'active' : '' }}">
            <i class="bi bi-bank"></i>
            <span>Kas / Akun</span>
        </a>


        <!-- ================= LAPORAN ================= -->
        <div class="sidebar-section-title">
            LAPORAN
        </div>

        <a href="{{ route('reports.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">
            <i class="bi bi-bar-chart"></i>
            <span>Pusat Laporan</span>
        </a>

        <a href="{{ route('reports.sales.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.sales.*') ? 'active' : '' }}">
            <i class="bi bi-graph-up"></i>
            <span>Laporan Penjualan</span>
        </a>

        <a href="{{ route('reports.purchases.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.purchases.*') ? 'active' : '' }}">
            <i class="bi bi-graph-down"></i>
            <span>Laporan Pembelian</span>
        </a>

        <a href="{{ route('reports.cash-flow.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.cash-flow.*') ? 'active' : '' }}">
            <i class="bi bi-arrow-left-right"></i>
            <span>Laporan Arus Kas</span>
        </a>

        <a href="{{ route('reports.profit-loss.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.profit-loss.*') ? 'active' : '' }}">
            <i class="bi bi-pie-chart"></i>
            <span>Laporan Laba Rugi</span>
        </a>

        <a href="{{ route('reports.stock.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.stock.*') ? 'active' : '' }}">
            <i class="bi bi-boxes"></i>
            <span>Laporan Stok</span>
        </a>

        <a href="{{ route('reports.receivables.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.receivables.*') ? 'active' : '' }}">
            <i class="bi bi-wallet"></i>
            <span>Laporan Piutang</span>
        </a>

        <a href="{{ route('reports.payables.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.payables.*') ? 'active' : '' }}">
            <i class="bi bi-credit-card"></i>
            <span>Laporan Hutang</span>
        </a>


        <!-- ================= SYSTEM ================= -->
        <div class="sidebar-section-title">
            SYSTEM
        </div>

        <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">
            <i class="bi bi-person-gear"></i>
            <span>Manajemen User</span>
        </a>

        <a href="{{ route('activity-logs.index') }}"
            class="sidebar-link {{ request()->routeIs('activity-logs.*') ? 'active' : '' }}">
            <i class="bi bi-clock-history"></i>
            <span>Riwayat Aktivitas</span>
        </a>

    </div>
</aside>
