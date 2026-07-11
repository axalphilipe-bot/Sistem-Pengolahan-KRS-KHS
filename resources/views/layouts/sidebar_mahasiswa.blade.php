<aside class="mhs-sidebar" id="mhsSidebar">

    <button type="button" class="mhs-sidebar-close" id="mhsSidebarClose" aria-label="Tutup menu">
        <i class="fa-solid fa-xmark"></i>
    </button>

    <div class="mhs-sidebar-brand">
        <div class="mhs-sidebar-logo-wrap">
            <img src="{{ asset('img/logo.png') }}" alt="Polibatam" class="mhs-sidebar-logo">
        </div>
        <div class="mhs-sidebar-brand-text">
            <h2 class="mhs-sidebar-title">Sistem KRS & KHS</h2>
            <p class="mhs-sidebar-subtitle">
                <i class="fa-solid fa-user-graduate"></i>
                Panel Mahasiswa
            </p>
        </div>
    </div>

    <nav class="mhs-sidebar-menu">

        <div class="mhs-sidebar-group">
            <p class="mhs-sidebar-label">Menu Utama</p>

            <a href="/home"
               class="mhs-sidebar-link {{ request()->is('home') ? 'active' : '' }}">
                <span class="mhs-sidebar-icon"><i class="fa-solid fa-house"></i></span>
                <span class="mhs-sidebar-link-text">Dashboard</span>
            </a>

            <a href="/krs"
               class="mhs-sidebar-link {{ request()->is('krs*') ? 'active' : '' }}">
                <span class="mhs-sidebar-icon"><i class="fa-solid fa-file-signature"></i></span>
                <span class="mhs-sidebar-link-text">KRS</span>
            </a>

            <a href="/khs"
               class="mhs-sidebar-link {{ request()->is('khs*') ? 'active' : '' }}">
                <span class="mhs-sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
                <span class="mhs-sidebar-link-text">KHS</span>
            </a>
        </div>

        <div class="mhs-sidebar-group">
            <p class="mhs-sidebar-label">Akun</p>

            <a href="/profil"
               class="mhs-sidebar-link {{ request()->is('profil*') ? 'active' : '' }}">
                <span class="mhs-sidebar-icon"><i class="fa-solid fa-user"></i></span>
                <span class="mhs-sidebar-link-text">Profil</span>
            </a>

            <a href="/panduan"
               class="mhs-sidebar-link {{ request()->is('panduan*') ? 'active' : '' }}">
                <span class="mhs-sidebar-icon"><i class="fa-solid fa-circle-question"></i></span>
                <span class="mhs-sidebar-link-text">Panduan</span>
            </a>
        </div>

    </nav>

    <div class="mhs-sidebar-footer">
        <div class="mhs-sidebar-user">
            <div class="mhs-sidebar-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'M', 0, 1)) }}
            </div>
            <div class="mhs-sidebar-user-info">
                <strong>{{ auth()->user()->name ?? 'Mahasiswa' }}</strong>
                <span><i class="fa-solid fa-circle"></i> Mahasiswa Aktif</span>
            </div>
        </div>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="mhs-sidebar-logout">
                <i class="fa-solid fa-right-from-bracket"></i>
                Logout
            </button>
        </form>
    </div>

</aside>

<div class="mhs-sidebar-overlay" id="mhsSidebarOverlay"></div>
