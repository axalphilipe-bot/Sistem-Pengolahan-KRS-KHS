<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Administrator | Sistem Pengelolaan KRS & KHS</title>

    <!-- CSS -->
   <!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- CSS -->
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
<link rel="stylesheet" href="{{ asset('css/admin-sidebar.css') }}">
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

@stack('styles')

<!-- Font Awesome -->
<link
rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
</head>

<body>

<div class="admin-container">

    <!-- ===========================
         SIDEBAR
    ============================ -->

    <aside class="sidebar" id="adminSidebar">

        <button type="button" class="sidebar-close" id="sidebarClose" aria-label="Tutup menu">
            <i class="fa-solid fa-xmark"></i>
        </button>

        <div class="sidebar-brand">
            <div class="sidebar-logo-wrap">
                <img src="{{ asset('img/logo.png') }}" alt="Polibatam" class="sidebar-logo">
            </div>
            <div class="sidebar-brand-text">
                <h2 class="sidebar-app-title">Sistem KRS & KHS</h2>
                <p class="sidebar-app-subtitle">
                    <i class="fa-solid fa-shield-halved"></i>
                    Panel Administrator
                </p>
            </div>
        </div>

        <nav class="sidebar-menu">

            <div class="sidebar-group">
                <p class="sidebar-section-label">Menu Utama</p>

                <a href="/admin" class="sidebar-link {{ request()->is('admin') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-house"></i></span>
                    <span class="sidebar-link-text">Dashboard</span>
                </a>

                <a href="/admin/mahasiswa" class="sidebar-link {{ request()->is('admin/mahasiswa*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-user-graduate"></i></span>
                    <span class="sidebar-link-text">Data Mahasiswa</span>
                </a>

                <a href="/admin/dosen" class="sidebar-link {{ request()->is('admin/dosen*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-chalkboard-user"></i></span>
                    <span class="sidebar-link-text">Data Dosen</span>
                </a>

                <a href="/admin/matkul" class="sidebar-link {{ request()->is('admin/matkul*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-book-open"></i></span>
                    <span class="sidebar-link-text">Mata Kuliah</span>
                </a>
            </div>

            <div class="sidebar-group">
                <p class="sidebar-section-label">Pengelolaan KRS</p>

                <a href="/admin/krs" class="sidebar-link {{ request()->is('admin/krs*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-file-signature"></i></span>
                    <span class="sidebar-link-text">Pengajuan KRS</span>
                </a>
            </div>

            <div class="sidebar-group">
                <p class="sidebar-section-label">Laporan</p>

                <a href="/admin/laporan-krs" class="sidebar-link {{ request()->is('admin/laporan-krs*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-chart-column"></i></span>
                    <span class="sidebar-link-text">Laporan KRS</span>
                </a>

                <a href="/admin/laporan-khs" class="sidebar-link {{ request()->is('admin/laporan-khs*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-file-lines"></i></span>
                    <span class="sidebar-link-text">Laporan KHS</span>
                </a>
            </div>

            <div class="sidebar-group">
                <p class="sidebar-section-label">Sistem</p>

                <a href="/admin/pengaturan" class="sidebar-link {{ request()->is('admin/pengaturan*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-gear"></i></span>
                    <span class="sidebar-link-text">Pengaturan</span>
                </a>

                <a href="/admin/pengguna" class="sidebar-link {{ request()->is('admin/pengguna*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-users-gear"></i></span>
                    <span class="sidebar-link-text">Pengguna & Hak Akses</span>
                </a>

                <a href="/admin/log" class="sidebar-link {{ request()->is('admin/log*') ? 'active' : '' }}">
                    <span class="sidebar-icon"><i class="fa-solid fa-clock-rotate-left"></i></span>
                    <span class="sidebar-link-text">Log Aktivitas</span>
                </a>
            </div>

        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="sidebar-user-avatar">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="sidebar-user-info">
                    <strong>{{ auth()->user()->name ?? 'Administrator' }}</strong>
                    <span><i class="fa-solid fa-circle"></i> Polibatam</span>
                </div>
            </div>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="sidebar-logout">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    Logout
                </button>
            </form>
        </div>

    </aside>

    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- ===========================
         MAIN CONTENT
    ============================ -->

    <button type="button" class="sidebar-toggle" id="sidebarToggle" aria-label="Buka menu">
        <i class="fa-solid fa-bars"></i>
    </button>

    <main class="main-content">

        @yield('content')

    </main>

</div>

<!-- ===========================
     SCRIPT
=========================== -->

<script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script src="{{ asset('js/admin-sidebar.js') }}"></script>

@stack('scripts')

</body>

</html>