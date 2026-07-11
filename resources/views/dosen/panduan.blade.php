@extends('layouts.dosen')

@section('content')

<div class="dosen-dashboard dosen-panduan">

    {{-- Hero --}}
    <div class="dashboard-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-book-open"></i>
                Panduan Pengguna
            </span>
            <h1>Panduan Dosen</h1>
            <p>
                Pelajari cara menggunakan Sistem Pengelolaan KRS & KHS untuk
                mengelola kelas, memvalidasi KRS mahasiswa, dan menginput nilai perkuliahan.
            </p>
        </div>

        <div class="hero-date">
            <span>Panel</span>
            <h3>Dosen</h3>
            <small>Sistem KRS & KHS</small>
        </div>
    </div>

    {{-- Fitur utama --}}
    <div class="panduan-features">
        <a href="#kelas" class="feature-card">
            <div class="feature-icon blue">
                <i class="fa-solid fa-users"></i>
            </div>
            <h3>Data Kelas</h3>
            <p>Lihat mata kuliah yang diampu dan daftar mahasiswa terdaftar.</p>
        </a>

        <a href="#validasi" class="feature-card">
            <div class="feature-icon orange">
                <i class="fa-solid fa-file-circle-check"></i>
            </div>
            <h3>Validasi KRS</h3>
            <p>Setujui atau tolak pengajuan KRS mahasiswa bimbingan.</p>
        </a>

        <a href="#nilai" class="feature-card">
            <div class="feature-icon teal">
                <i class="fa-solid fa-pen-to-square"></i>
            </div>
            <h3>Input Nilai</h3>
            <p>Input nilai manual atau import dari file Excel.</p>
        </a>

        <a href="#export" class="feature-card">
            <div class="feature-icon purple">
                <i class="fa-solid fa-file-pdf"></i>
            </div>
            <h3>Export PDF</h3>
            <p>Unduh laporan daftar kelas dalam format PDF.</p>
        </a>
    </div>

    {{-- Panduan langkah demi langkah --}}
    <div class="guide-sections">

        {{-- Dashboard & Kelas --}}
        <div class="guide-panel" id="kelas">
            <div class="guide-panel-header">
                <div class="guide-number blue">1</div>
                <div>
                    <h3><i class="fa-solid fa-chalkboard"></i> Mengelola Data Kelas</h3>
                    <p>Lihat dan kelola mata kuliah yang Anda ampu pada semester aktif.</p>
                </div>
                <a href="/dosen/kelas" class="guide-link">
                    Buka Data Kelas <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Buka menu Dashboard atau Data Kelas</strong>
                        <p>Dashboard menampilkan ringkasan kelas pengampu. Data Kelas menampilkan daftar lengkap dengan filter.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Periksa daftar mata kuliah</strong>
                        <p>Setiap baris menampilkan kode MK, nama mata kuliah, SKS, semester, dan jumlah mahasiswa terdaftar.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">03</span>
                    <div class="step-content">
                        <strong>Klik "Lihat KRS" untuk detail mahasiswa</strong>
                        <p>Halaman detail menampilkan daftar mahasiswa yang mengambil mata kuliah tersebut beserta status KRS-nya.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">04</span>
                    <div class="step-content">
                        <strong>Klik "Input Nilai" untuk memasukkan nilai</strong>
                        <p>Anda akan diarahkan ke halaman input nilai untuk mata kuliah yang dipilih.</p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Validasi KRS --}}
        <div class="guide-panel" id="validasi">
            <div class="guide-panel-header">
                <div class="guide-number orange">2</div>
                <div>
                    <h3><i class="fa-solid fa-circle-check"></i> Validasi KRS Mahasiswa</h3>
                    <p>Proses persetujuan pengajuan KRS mahasiswa bimbingan Anda.</p>
                </div>
                <a href="/dosen/validasi" class="guide-link">
                    Buka Validasi KRS <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Buka menu Validasi KRS</strong>
                        <p>Halaman ini menampilkan semua pengajuan KRS dari mahasiswa yang Anda bimbingi (dosen wali).</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Gunakan filter dan pencarian</strong>
                        <p>Filter berdasarkan status (Pending, Disetujui, Ditolak) atau cari berdasarkan NIM, nama, dan mata kuliah.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">03</span>
                    <div class="step-content">
                        <strong>Periksa data pengajuan</strong>
                        <p>Pastikan mahasiswa memenuhi syarat akademik dan mengambil mata kuliah yang sesuai dengan kurikulum.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">04</span>
                    <div class="step-content">
                        <strong>Klik "Setujui" atau "Tolak"</strong>
                        <p>Pengajuan dengan status Pending dapat disetujui atau ditolak. Status akan langsung terupdate di sistem.</p>
                    </div>
                </div>
            </div>

            <div class="guide-note warning">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    <strong>Penting!</strong>
                    Validasi KRS harus diselesaikan sebelum perkuliahan dimulai agar mahasiswa dapat mengikuti kelas sesuai jadwal.
                </div>
            </div>
        </div>

        {{-- Input Nilai --}}
        <div class="guide-panel" id="nilai">
            <div class="guide-panel-header">
                <div class="guide-number teal">3</div>
                <div>
                    <h3><i class="fa-solid fa-graduation-cap"></i> Input Nilai Perkuliahan</h3>
                    <p>Masukkan nilai mahasiswa secara manual atau melalui import Excel.</p>
                </div>
                <a href="/dosen" class="guide-link">
                    Ke Dashboard <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Pilih mata kuliah dari Dashboard atau Data Kelas</strong>
                        <p>Klik tombol "Input Nilai" pada baris mata kuliah yang ingin dinilai.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Isi komponen penilaian</strong>
                        <p>Masukkan nilai untuk setiap komponen: Keaktifan, Proyek, Tugas, Kuis, UTS, dan UAS.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">03</span>
                    <div class="step-content">
                        <strong>Atau gunakan Import Excel</strong>
                        <p>Download template Excel, isi data nilai, lalu upload melalui tombol "Pilih File Excel" → "Import Excel".</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">04</span>
                    <div class="step-content">
                        <strong>Simpan nilai</strong>
                        <p>Sistem akan otomatis menghitung nilai akhir, nilai huruf (A–E), dan indeks nilai berdasarkan bobot penilaian.</p>
                    </div>
                </div>
            </div>

            <div class="bobot-info">
                <h4><i class="fa-solid fa-scale-balanced"></i> Komposisi Penilaian</h4>
                <div class="bobot-grid">
                    <div class="bobot-item"><span>Keaktifan</span><strong>15%</strong></div>
                    <div class="bobot-item"><span>Proyek</span><strong>35%</strong></div>
                    <div class="bobot-item"><span>Tugas</span><strong>10%</strong></div>
                    <div class="bobot-item"><span>Kuis</span><strong>10%</strong></div>
                    <div class="bobot-item"><span>UTS</span><strong>15%</strong></div>
                    <div class="bobot-item"><span>UAS</span><strong>15%</strong></div>
                </div>
            </div>
        </div>

        {{-- Export PDF --}}
        <div class="guide-panel" id="export">
            <div class="guide-panel-header">
                <div class="guide-number purple">4</div>
                <div>
                    <h3><i class="fa-solid fa-file-export"></i> Export Laporan PDF</h3>
                    <p>Unduh daftar kelas pengampu dalam format PDF untuk arsip atau cetak.</p>
                </div>
                <a href="/dosen/kelas" class="guide-link">
                    Buka Data Kelas <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list steps-compact">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Buka halaman Data Kelas</strong>
                        <p>Menu Data Kelas berisi daftar lengkap mata kuliah yang Anda ampu.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Klik tombol "Export PDF"</strong>
                        <p>File PDF akan otomatis terunduh berisi informasi kelas dan jumlah mahasiswa.</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- FAQ --}}
    <div class="faq-panel">
        <div class="panel-header">
            <h3><i class="fa-solid fa-circle-question"></i> Pertanyaan Umum (FAQ)</h3>
        </div>

        <div class="faq-list">
            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>Siapa mahasiswa yang muncul di Validasi KRS?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Yang muncul hanya mahasiswa bimbingan Anda (dosen wali). Pastikan data NUPTK dosen wali sudah terdaftar di profil mahasiswa oleh admin.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>Apakah KRS yang sudah disetujui bisa dibatalkan?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Untuk perubahan status KRS yang sudah disetujui, hubungi administrator sistem. Dosen dapat menolak pengajuan yang masih berstatus Pending.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>Bagaimana cara import nilai via Excel?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Di halaman Input Nilai, klik "Download Template" untuk mendapatkan format Excel. Isi nilai mahasiswa, simpan file, lalu klik "Pilih File Excel" dan "Import Excel". Pastikan NIM dan format kolom sesuai template.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>Bagaimana nilai akhir dihitung?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Nilai akhir dihitung otomatis berdasarkan bobot: Keaktifan 15%, Proyek 35%, Tugas 10%, Kuis 10%, UTS 15%, UAS 15%. Sistem juga menentukan nilai huruf dan indeks nilai secara otomatis.</p>
                </div>
            </div>

            <div class="faq-item">
                <button class="faq-question" type="button">
                    <span>Mengapa mata kuliah saya tidak muncul di dashboard?</span>
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Pastikan nama dosen pada data mata kuliah sesuai dengan akun Anda. Hubungi admin jika mata kuliah belum muncul setelah data diperbarui.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tips --}}
    <div class="tips-grid">
        <div class="tip-card">
            <div class="tip-icon">
                <i class="fa-solid fa-clock"></i>
            </div>
            <h4>Validasi Tepat Waktu</h4>
            <p>Selesaikan validasi KRS sebelum perkuliahan dimulai agar mahasiswa tidak terkendala akses kelas.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <i class="fa-solid fa-file-excel"></i>
            </div>
            <h4>Gunakan Template Excel</h4>
            <p>Import nilai via Excel lebih efisien untuk kelas dengan banyak mahasiswa. Selalu gunakan template resmi.</p>
        </div>

        <div class="tip-card">
            <div class="tip-icon">
                <i class="fa-solid fa-shield-halved"></i>
            </div>
            <h4>Periksa Sebelum Simpan</h4>
            <p>Double-check nilai sebelum menyimpan. Pastikan tidak ada nilai di luar rentang 0–100.</p>
        </div>
    </div>

    {{-- Bantuan --}}
    <div class="info-banner">
        <i class="fa-solid fa-headset"></i>
        <span>Butuh bantuan lebih lanjut? Hubungi administrator sistem atau bagian akademik kampus untuk masalah teknis dan data akademik.</span>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.faq-question').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var item = this.closest('.faq-item');
            var isOpen = item.classList.contains('open');

            document.querySelectorAll('.faq-item.open').forEach(function (el) {
                el.classList.remove('open');
            });

            if (!isOpen) {
                item.classList.add('open');
            }
        });
    });

    document.querySelectorAll('.panduan-features a[href^="#"]').forEach(function (link) {
        link.addEventListener('click', function (e) {
            e.preventDefault();
            var target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        });
    });
});
</script>
@endpush
