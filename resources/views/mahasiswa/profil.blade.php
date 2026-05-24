@extends('layouts.mahasiswa')

@section('content')

    <div class="profile-container">

        <h2>Profil Mahasiswa</h2>

        <div class="profile-card">

            <div class="profile-left">
                <i class="fas fa-user-circle"></i>
            </div>

            <div class="profile-right">
                <div class="profile-header">
                    <h3>Nama : {{ auth()->user()?->name ?? '-' }}</h3>

                    <div class="btn-group">
                        <button class="btn-edit" id="openModal">Edit Profil</button>
                        <button class="btn-password" id="openPasswordModal">Edit Password</button>
                    </div>
                </div>

                <hr>

                <p><b>NIM:</b> {{ auth()->user()->nim ?? '-' }}</p>
                <p><b>Jurusan:</b> {{ auth()->user()->prodi ?? '-' }}</p>
                <p><b>Semester Aktif:</b> 4 (2025/2026 Genap)</p>

                <hr>

                <p><b>Alamat:</b> {{ auth()->user()->alamat ?? '-' }}</p>
                <p><b>Email:</b> {{ auth()->user()->email ?? '-'}}</p>
                <p><b>Telepon:</b> {{ auth()->user()->no_hp ?? '-' }}</p>

            </div>

        </div>

    </div>

    <div id="editModal" class="modal">
        <div class="modal-content">

            <span class="close">&times;</span>

            <h3>Edit Profil</h3>

           <form method="POST"
      action="{{ route('profile.update') }}">
                @csrf

                <div class="form-group">
                    <label>Nama</label>
                    <input type="text" name="name" value="{{ auth()->user()->name ?? ''  }}">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="email" name="email" value="{{ auth()->user()->email ?? ''  }}">
                </div>

                <div class="form-group">
                    <label>Telepon</label>
                    <input type="text" name="no_hp" value="{{ auth()->user()->no_hp  ?? '' }}">
                </div>

                <div class="form-group full">
                    <label>Alamat</label>
                    <textarea name="alamat">{{ auth()->user()->alamat ?? ''  }}</textarea>
                </div>

                <button type="submit" class="btn-save full">Simpan</button>

            </form>

        </div>
    </div>

    <!-- MODAL PASSWORD (FIXED - DI LUAR) -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">

            <span class="close-password">&times;</span>

            <h3>Edit Password</h3>

            <form method="POST" action="{{ route('profile.password') }}">
                @csrf

                <div class="form-group">
                    <label>Password Lama</label>
                    <input type="password" name="old_password" required>
                </div>

                <div class="form-group">
                    <label>Password Baru</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="form-group">
                    <label>Konfirmasi Password</label>
                    <input type="password" name="confirm_password" required>
                </div>

                <button type="submit" class="btn-save">Simpan Password</button>

            </form>

        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {

            const modal = document.getElementById("editModal");
            const btn = document.getElementById("openModal");
            const close = document.querySelector("#editModal .close");

            const passModal = document.getElementById("passwordModal");
            const btnPass = document.getElementById("openPasswordModal");
            const closePass = document.querySelector("#passwordModal .close-password");

            btn.onclick = () => modal.style.display = "block";
            close.onclick = () => modal.style.display = "none";

            btnPass.onclick = () => passModal.style.display = "block";
            closePass.onclick = () => passModal.style.display = "none";

            window.onclick = function (event) {
                if (event.target == modal) modal.style.display = "none";
                if (event.target == passModal) passModal.style.display = "none";
            };

        });
    </script>

@endsection