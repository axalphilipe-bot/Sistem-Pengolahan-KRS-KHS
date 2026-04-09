@extends('layouts.app')

@section('content')

<div class="profile-container">

    <h2>Profil Mahasiswa</h2>

    <div class="profile-card">

        <!-- FOTO -->
        <div class="profile-left">
            <i class="fas fa-user-circle"></i>
        </div>

        <!-- DATA -->
        <div class="profile-right">

            <div class="profile-header">
                <h3>Nama Mahasiswa</h3>
                <button class="btn-edit" id="openModal">Edit Profil</button>
            </div>

            <hr>

            <p><b>NIM:</b> 123456789</p>
            <p><b>Jurusan:</b> Teknik Informatika</p>
            <p><b>Semester Aktif:</b> 4 (2025/2026 Genap)</p>

            <hr>

            <p><b>Alamat:</b> Jl. No 321, Batam</p>
            <p><b>Email:</b> namamahasiswa@gmail.com</p>
            <p><b>Telepon:</b> 089876543123</p>

        </div>

    </div>

</div>

<!-- MODAL EDIT PROFIL -->
<div id="editModal" class="modal">

    <div class="modal-content">

        <span class="close">&times;</span>

        <h3>Edit Profil</h3>

        <form class="form-grid">

            <div class="form-group">
                <label>Nama</label>
                <input type="text" value="Nama Mahasiswa">
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" value="namamahasiswa@gmail.com">
            </div>

            <div class="form-group">
                <label>Telepon</label>
                <input type="text" value="089876543123">
            </div>

            <div class="form-group full">
                <label>Alamat</label>
                <textarea>Jl. No 321, Batam</textarea>
            </div>

            <button type="submit" class="btn-save full">Simpan</button>

        </form>

    </div>

</div>
@endsection