<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>KRS & KHS</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dosen.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

    <div class="app-layout">

        <!-- SIDEBAR -->
       <div class="app-sidebar">
    <div class="app-logo">
        <img src="{{ asset('img/logo.png') }}">
    </div>

    {{-- MAHASISWA --}}
    @if(auth()->user()->role == 'mahasiswa')

        <a href="{{ route('home') }}" class="app-menu-item">
            <i class="fas fa-home"></i>
            <span>BERANDA</span>
        </a>

        <a href="{{ route('krs') }}" class="app-menu-item">
            <i class="fas fa-book"></i>
            <span>KRS</span>
        </a>

        <a href="{{ route('khs') }}" class="app-menu-item">
            <i class="fas fa-list"></i>
            <span>KHS</span>
        </a>

        <a href="{{ route('panduan') }}" class="app-menu-item">
            <i class="fas fa-book-open"></i>
            <span>PANDUAN</span>
        </a>

        <a href="{{ route('profil') }}" class="app-menu-item">
            <i class="fas fa-user"></i>
            <span>PROFIL</span>
        </a>

    {{-- DOSEN --}}
    @elseif(auth()->user()->role == 'dosen')

        <a href="/dosen" class="app-menu-item">
            <i class="fas fa-home"></i>
            <span>DASHBOARD</span>
        </a>

        <a href="/dosen/kelas" class="app-menu-item">
            <i class="fas fa-users"></i>
            <span>KELAS SAYA</span>
        </a>

        <a href="/dosen/validasi" class="app-menu-item">
    <i class="fas fa-check"></i>
    <span>VALIDASI KRS</span>
</a>
<a href="/dosen/panduan" class="app-menu-item">
    <i class="fas fa-book"></i>
    <span>PANDUAN</span>
</a>

    {{--  ADMIN --}}
    @elseif(auth()->user()->role == 'admin')

        <a href="/admin" class="app-menu-item">
            <i class="fas fa-home"></i>
            <span>DASHBOARD</span>
        </a>

        <a href="/admin/users" class="app-menu-item">
            <i class="fas fa-users"></i>
            <span>DATA USER</span>
        </a>

        <a href="/admin/matkul" class="app-menu-item">
            <i class="fas fa-book"></i>
            <span>MATA KULIAH</span>
        </a>

    @endif

    {{-- 🔥 LOGOUT (UNTUK SEMUA ROLE) --}}
    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="app-menu-item logout-btn">
            <i class="fas fa-sign-out-alt"></i>
            <span>LOGOUT</span>
        </button>
    </form>
        </div>


        <!-- MAIN -->
        <div class="app-main">
            <div class="app-topbar">
             <div class="topbar-left">
                <button id="toggleSidebar" class="toggle-btn">
                    <span></span>
                    <span></span>
                    <span></span>
                </button>
            </div>       
                <div class="user">
                    <p1>{{ auth()->user()?->name ?? '-' }}</p1>
                </div>

            </div>

            <div class="app-content">
                @yield('content')
            </div>

        </div>

    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const btn = document.getElementById("toggleSidebar");
            const sidebar = document.querySelector(".app-sidebar");
            const main = document.querySelector(".app-main");

            btn.addEventListener("click", function () {
                sidebar.classList.toggle("active");
                main.classList.toggle("shift");
                btn.classList.toggle("active"); // 🔥 ini tambahan
            });

        });
    </script>
    </script>
</body>

</html>