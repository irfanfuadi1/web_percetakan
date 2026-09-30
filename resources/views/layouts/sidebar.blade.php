<style>
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
    }

    .sidebar-brand {
        height: 70px;
        display: flex;
        align-items: center;
        padding: 0 22px;
        font-size: 21px;
        font-weight: 700;
        color: #6257e8;
        border-bottom: 1px solid #f0f0f0;
    }

    .sidebar-menu {
        padding: 15px 12px;
    }

    .menu-title {
        font-size: 10px;
        font-weight: 700;
        color: #999;
        margin: 20px 12px 8px;
        letter-spacing: .5px;
    }

    .sidebar-link {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 10px 13px;
        margin-bottom: 4px;
        color: #555;
        text-decoration: none;
        border-radius: 7px;
        font-size: 13px;
        transition: .2s;
    }

    .sidebar-link i {
        font-size: 16px;
        width: 20px;
    }

    .sidebar-link:hover {
        background: #f1efff;
        color: #6257e8;
    }

    .sidebar-link.active {
        background: #665ce6;
        color: #fff;
    }

    .sidebar-link.active:hover {
        color: #fff;
    }

    @media (max-width: 991px) {
        .sidebar {
            display: none;
        }
    }
</style>

<aside class="sidebar">

    <div class="sidebar-brand">
        Gemiprint
    </div>

    <div class="sidebar-menu">

        {{-- DASHBOARD --}}
        <a href="{{ route('dashboard') }}" class="sidebar-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">

            <i class="bi bi-grid"></i>
            <span>Dashboard</span>

        </a>


        {{-- PRODUKSI --}}
        <div class="menu-title">
            PRODUKSI
        </div>

        <a href="{{ route('production-queues.index') }}"
            class="sidebar-link {{ request()->routeIs('production-queues.*') ? 'active' : '' }}">

            <i class="bi bi-scissors"></i>
            <span>Antrian Produksi</span>

        </a>


        {{-- TRANSAKSI --}}
        <div class="menu-title">
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

            <i class="bi bi-bag"></i>
            <span>Pembelian</span>

        </a>


        {{-- MASTER DATA --}}
        <div class="menu-title">
            MASTER DATA
        </div>

        {{-- KATEGORI --}}
        <a href="{{ route('categories.index') }}"
            class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">

            <i class="bi bi-tags"></i>
            <span>Kategori</span>

        </a>

        {{-- MASTER ITEM --}}
        <a href="{{ route('products.index') }}"
            class="sidebar-link {{ request()->routeIs('products.*') ? 'active' : '' }}">

            <i class="bi bi-box-seam"></i>
            <span>Master Item</span>

        </a>

        {{-- PELANGGAN --}}
        <a href="{{ route('customers.index') }}"
            class="sidebar-link {{ request()->routeIs('customers.*') ? 'active' : '' }}">

            <i class="bi bi-people"></i>
            <span>Pelanggan</span>

        </a>

        {{-- SUPPLIER --}}
        <a href="{{ route('suppliers.index') }}"
            class="sidebar-link {{ request()->routeIs('suppliers.*') ? 'active' : '' }}">

            <i class="bi bi-truck"></i>
            <span>Supplier</span>

        </a>

        {{-- MASTER KAS / AKUN --}}
        <a href="{{ route('cash-accounts.index') }}"
            class="sidebar-link {{ request()->routeIs('cash-accounts.*') ? 'active' : '' }}">

            <i class="bi bi-cash-stack"></i>
            <span>Master Kas</span>

        </a>

        {{-- PENGELUARAN --}}
        <a href="{{ route('expenses.index') }}"
            class="sidebar-link {{ request()->routeIs('expenses.*') ? 'active' : '' }}">

            <i class="bi bi-cash-coin"></i>
            <span>Pengeluaran</span>

        </a>


        {{-- LAPORAN --}}
        <div class="menu-title">
            LAPORAN
        </div>


        {{-- PUSAT LAPORAN --}}
        <a href="{{ route('reports.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.index') ? 'active' : '' }}">

            <i class="bi bi-grid"></i>
            <span>Pusat Laporan</span>

        </a>

        {{-- LAPORAN PENJUALAN --}}
        <a href="{{ route('reports.sales.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.sales.*') ? 'active' : '' }}">

            <i class="bi bi-graph-up"></i>
            <span>Laporan Penjualan</span>

        </a>

        {{-- LAPORAN PEMBELIAN --}}
        <a href="{{ route('reports.purchases.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.purchases.*') ? 'active' : '' }}">

            <i class="bi bi-bag"></i>
            <span>Laporan Pembelian</span>

        </a>

        {{-- LAPORAN ARUS KAS --}}
        <a href="{{ route('reports.cash-flow.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.cash-flow.*') ? 'active' : '' }}">

            <i class="bi bi-wallet2"></i>
            <span>Laporan Arus Kas</span>

        </a>

        {{-- LAPORAN LABA RUGI --}}
        <a href="{{ route('reports.profit-loss.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.profit-loss.*') ? 'active' : '' }}">

            <i class="bi bi-graph-up-arrow"></i>
            <span>Laporan Laba Rugi</span>

        </a>

        {{-- LAPORAN STOK --}}
        <a href="{{ route('reports.stock.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.stock.*') ? 'active' : '' }}">

            <i class="bi bi-box-seam"></i>
            <span>Laporan Stok</span>

        </a>

        {{-- LAPORAN PIUTANG --}}
        <a href="{{ route('reports.receivables.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.receivables.*') ? 'active' : '' }}">

            <i class="bi bi-journal-arrow-down"></i>
            <span>Laporan Piutang</span>

        </a>

        {{-- LAPORAN HUTANG --}}
        <a href="{{ route('reports.payables.index') }}"
            class="sidebar-link {{ request()->routeIs('reports.payables.*') ? 'active' : '' }}">

            <i class="bi bi-journal-arrow-up"></i>
            <span>Laporan Hutang</span>

        </a>


        {{-- SYSTEM --}}
        <div class="menu-title">
            SYSTEM
        </div>

        <a href="{{ route('users.index') }}" class="sidebar-link {{ request()->routeIs('users.*') ? 'active' : '' }}">

            <i class="bi bi-people-fill"></i>

            <span>Manajemen User</span>

        </a>

        <a href="#" class="sidebar-link">

            <i class="bi bi-clock-history"></i>

            <span>Riwayat Aktivitas</span>

        </a>
    </div>

</aside>
