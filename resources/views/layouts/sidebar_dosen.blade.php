<aside class="dosen-sidebar" id="dosenSidebar">

    <button type="button" class="dosen-sidebar-close" id="dosenSidebarClose" aria-label="Tutup menu">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="dosen-sidebar-brand">
        <div class="dosen-sidebar-logo-wrap">
            <img src="{{ asset('img/logo.png') }}" alt="Polibatam" class="dosen-sidebar-logo">
        </div>
        <div class="dosen-sidebar-brand-text">
            <h2 class="dosen-sidebar-title">Sistem KRS & KHS</h2>
            <p class="dosen-sidebar-subtitle">
                <i class="fa-solid fa-chalkboard-user"></i>
                Panel Dosen
            </p>
        </div>
    </div>

    <nav class="dosen-sidebar-menu">

        <div class="dosen-sidebar-group">
            <p class="dosen-sidebar-label">Menu Utama</p>

            <a href="/dosen"
               class="dosen-sidebar-link {{ request()->is('dosen') ? 'active' : '' }}">
                <span class="dosen-sidebar-icon"><i class="fa-solid fa-house"></i></span>
                <span class="dosen-sidebar-link-text">Dashboard</span>
            </a>

            <a href="/dosen/kelas"
               class="dosen-sidebar-link {{ request()->is('dosen/kelas*') ? 'active' : '' }}">
                <span class="dosen-sidebar-icon"><i class="fa-solid fa-users"></i></span>
                <span class="dosen-sidebar-link-text">Data Kelas</span>
            </a>
        </div>

        <div class="dosen-sidebar-group">
            <p class="dosen-sidebar-label">Pengelolaan</p>

            <a href="/dosen/validasi"
               class="dosen-sidebar-link {{ request()->is('dosen/validasi*') ? 'active' : '' }}">
                <span class="dosen-sidebar-icon"><i class="fa-solid fa-file-circle-check"></i></span>
                <span class="dosen-sidebar-link-text">Persetujuan KRS</span>
            </a>

            <a href="/dosen/nilai"
               class="dosen-sidebar-link {{ request()->is('dosen/nilai*') ? 'active' : '' }}">
                <span class="dosen-sidebar-icon"><i class="fa-solid fa-pen-to-square"></i></span>
                <span class="dosen-sidebar-link-text">Input Nilai</span>
            </a>
        </div>

        <div class="dosen-sidebar-group">
            <p class="dosen-sidebar-label">Bantuan</p>

            <a href="/dosen/panduan"
               class="dosen-sidebar-link {{ request()->is('dosen/panduan*') ? 'active' : '' }}">
                <span class="dosen-sidebar-icon"><i class="fa-solid fa-book-open"></i></span>
                <span class="dosen-sidebar-link-text">Panduan</span>
            </a>
        </div>

    </nav>

    <div class="dosen-sidebar-footer">
        <div class="dosen-sidebar-user">
            <div class="dosen-sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'D', 0, 1)) }}
            </div>
            <div class="dosen-sidebar-user-info">
                <strong>{{ auth()->user()->name }}</strong>
                <span><i class="fa-solid fa-circle"></i> Dosen Pengampu</span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="dosen-sidebar-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

</aside>

<div class="dosen-sidebar-overlay" id="dosenSidebarOverlay"></div>
