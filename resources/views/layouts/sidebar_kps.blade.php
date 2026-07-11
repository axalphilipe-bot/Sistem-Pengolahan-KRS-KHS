<aside class="kps-sidebar" id="kpsSidebar">

    <button type="button" class="kps-sidebar-close" id="kpsSidebarClose" aria-label="Tutup menu">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="kps-sidebar-brand">
        <div class="kps-sidebar-logo-wrap">
            <img src="{{ asset('img/logo.png') }}" alt="Polibatam" class="kps-sidebar-logo">
        </div>
        <div class="kps-sidebar-brand-text">
            <h2 class="kps-sidebar-title">Sistem KRS & KHS</h2>
            <p class="kps-sidebar-subtitle">
                <i class="fa-solid fa-user-tie"></i>
                Panel KPS
            </p>
        </div>
    </div>

    <nav class="kps-sidebar-menu">

        <div class="kps-sidebar-group">
            <p class="kps-sidebar-label">Menu Utama</p>

            <a href="/kps"
               class="kps-sidebar-link {{ request()->is('kps') ? 'active' : '' }}">
                <span class="kps-sidebar-icon"><i class="fa-solid fa-house"></i></span>
                <span class="kps-sidebar-link-text">Dashboard</span>
            </a>
        </div>

        <div class="kps-sidebar-group">
            <p class="kps-sidebar-label">Pengelolaan Nilai</p>

            <a href="/kps/approve"
               class="kps-sidebar-link {{ request()->is('kps/approve*') ? 'active' : '' }}">
                <span class="kps-sidebar-icon"><i class="fa-solid fa-circle-check"></i></span>
                <span class="kps-sidebar-link-text">Validasi Nilai</span>
            </a>

            <a href="/kps/kunci"
               class="kps-sidebar-link {{ request()->is('kps/kunci*') ? 'active' : '' }}">
                <span class="kps-sidebar-icon"><i class="fa-solid fa-lock"></i></span>
                <span class="kps-sidebar-link-text">Kunci Nilai</span>
            </a>
        </div>

        <div class="kps-sidebar-group">
            <p class="kps-sidebar-label">Laporan</p>

            <a href="/kps/laporan"
               class="kps-sidebar-link {{ request()->is('kps/laporan*') ? 'active' : '' }}">
                <span class="kps-sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="kps-sidebar-link-text">Laporan Nilai</span>
            </a>
        </div>

    </nav>

    <div class="kps-sidebar-footer">
        <div class="kps-sidebar-user">
            <div class="kps-sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'K', 0, 1)) }}
            </div>
            <div class="kps-sidebar-user-info">
                <strong>{{ auth()->user()->name ?? 'KPS' }}</strong>
                <span><i class="fa-solid fa-circle"></i> Ketua Program Studi</span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="kps-sidebar-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

</aside>

<div class="kps-sidebar-overlay" id="kpsSidebarOverlay"></div>
