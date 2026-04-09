<div class="navbar">
    <div class="logo">
    <img src="{{ asset('img/logo.png') }}" alt="Logo">

</div>

    <div class="menu">
        <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">
    Beranda
</a>
        <a href="{{ url('/krs') }}">KRS</a>
        <a href="{{ route('khs') }}">KHS</a>
        <a href="{{ route('jadwal') }}">Jadwal</a>
        <a href="#">Mata Kuliah</a>
        <a href="#">Panduan</a>
    </div>

 <a href="{{ route('profil') }}" class="user-link">
    <div class="user">
        <i class="fas fa-user-circle"></i>
        Nama Mahasiswa
    </div>
</a>
</div>