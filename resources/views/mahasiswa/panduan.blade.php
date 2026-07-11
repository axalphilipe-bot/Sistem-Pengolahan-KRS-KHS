@extends('layouts.mahasiswa')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/mahasiswa-panduan.css') }}">
@endpush

@section('content')

<div class="mhs-panduan">

    {{-- Hero --}}
    <div class="panduan-hero">
        <div class="hero-circle hero-circle-1"></div>
        <div class="hero-circle hero-circle-2"></div>

        <div class="hero-content">
            <span class="hero-badge">
                <i class="fa-solid fa-book-open"></i>
                Panduan Pengguna
            </span>
            <h1>Panduan Mahasiswa</h1>
            <p>
                Pelajari cara menggunakan Sistem Pengelolaan KRS & KHS untuk
                mengajukan mata kuliah, melihat nilai, dan mengelola profil akun.
            </p>
        </div>

        <div class="hero-date">
            <span>Panel</span>
            <h3>Mahasiswa</h3>
            <small>Sistem KRS & KHS</small>
        </div>
    </div>

    {{-- Fitur utama --}}
    <div class="panduan-features">
        <a href="#krs" class="feature-card">
            <div class="feature-icon blue">
                <i class="fa-solid fa-file-signature"></i>
            </div>
            <h3>Ambil KRS</h3>
            <p>Pilih semester dan mata kuliah, lalu ajukan KRS untuk disetujui dosen wali.</p>
        </a>

        <a href="#khs" class="feature-card">
            <div class="feature-icon green">
                <i class="fa-solid fa-file-lines"></i>
            </div>
            <h3>Lihat KHS</h3>
            <p>Cek nilai mata kuliah, IPS, IPK, dan unduh kartu hasil studi.</p>
        </a>

        <a href="#profil" class="feature-card">
            <div class="feature-icon orange">
                <i class="fa-solid fa-user-gear"></i>
            </div>
            <h3>Kelola Profil</h3>
            <p>Perbarui data kontak dan ubah password akun Anda.</p>
        </a>

        <a href="#faq" class="feature-card">
            <div class="feature-icon purple">
                <i class="fa-solid fa-circle-question"></i>
            </div>
            <h3>FAQ</h3>
            <p>Pertanyaan umum seputar KRS, KHS, dan batas SKS semester.</p>
        </a>
    </div>

    {{-- Panduan langkah demi langkah --}}
    <div class="guide-sections">

        <div class="guide-panel" id="krs">
            <div class="guide-panel-header">
                <div class="guide-number blue">1</div>
                <div>
                    <h3><i class="fa-solid fa-file-signature"></i> Cara Mengisi KRS</h3>
                    <p>Ajukan mata kuliah untuk semester aktif melalui menu KRS.</p>
                </div>
                <a href="/krs" class="guide-link">
                    Buka KRS <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Buka menu KRS</strong>
                        <p>Klik menu <em>KRS</em> di sidebar untuk membuka halaman pengajuan KRS.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Pilih Semester dan Program Studi</strong>
                        <p>Gunakan filter di bagian atas, lalu klik tombol <em>Tampilkan</em> untuk memuat daftar mata kuliah.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">03</span>
                    <div class="step-content">
                        <strong>Centang mata kuliah yang ingin diambil</strong>
                        <p>Pastikan total SKS tidak melebihi batas maksimal. Mata kuliah yang sudah pernah diajukan ditandai dengan badge status.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">04</span>
                    <div class="step-content">
                        <strong>Klik "Ambil KRS"</strong>
                        <p>Pengajuan akan masuk status <em>Menunggu</em> hingga disetujui dosen wali.</p>
                    </div>
                </div>
            </div>

            <div class="guide-note warning">
                <i class="fa-solid fa-triangle-exclamation"></i>
                <div>
                    <strong>Batas SKS</strong>
                    <p>Maksimal <strong>24 SKS</strong> per semester. Pastikan tidak ada bentrok jadwal kuliah.</p>
                </div>
            </div>
        </div>

        <div class="guide-panel" id="khs">
            <div class="guide-panel-header">
                <div class="guide-number green">2</div>
                <div>
                    <h3><i class="fa-solid fa-graduation-cap"></i> Cara Melihat KHS</h3>
                    <p>Lihat hasil studi dan indeks prestasi semester Anda.</p>
                </div>
                <a href="/khs" class="guide-link">
                    Buka KHS <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Buka menu KHS</strong>
                        <p>Klik menu <em>KHS</em> di sidebar untuk melihat kartu hasil studi.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Lihat ringkasan nilai</strong>
                        <p>Halaman menampilkan total SKS, IPS, IPK, dan daftar nilai per mata kuliah.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">03</span>
                    <div class="step-content">
                        <strong>Preview dan export PDF</strong>
                        <p>Klik <em>Lihat KHS</em> untuk preview dokumen, lalu <em>Export PDF</em> untuk mengunduh file resmi.</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="guide-panel" id="profil">
            <div class="guide-panel-header">
                <div class="guide-number orange">3</div>
                <div>
                    <h3><i class="fa-solid fa-user"></i> Mengelola Profil</h3>
                    <p>Perbarui informasi kontak dan keamanan akun mahasiswa.</p>
                </div>
                <a href="/profil" class="guide-link">
                    Buka Profil <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="steps-list">
                <div class="step-item">
                    <span class="step-num">01</span>
                    <div class="step-content">
                        <strong>Buka menu Profil</strong>
                        <p>Lihat identitas dan data akademik Anda di halaman profil.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">02</span>
                    <div class="step-content">
                        <strong>Edit Profil</strong>
                        <p>Ubah nama, email, dan nomor telepon melalui tombol <em>Edit Profil</em>.</p>
                    </div>
                </div>
                <div class="step-item">
                    <span class="step-num">03</span>
                    <div class="step-content">
                        <strong>Ubah Password</strong>
                        <p>Gunakan tombol <em>Ubah Password</em> untuk memperbarui kata sandi akun login.</p>
                    </div>
                </div>
            </div>

            <div class="guide-note">
                <i class="fa-solid fa-circle-info"></i>
                <div>
                    <strong>Data Akademik</strong>
                    <p>Program studi, semester, dan kelas dikelola oleh admin. Hubungi bagian akademik jika ada kesalahan data.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- FAQ --}}
    <div class="faq-panel" id="faq">
        <div class="section-title">
            <h2><i class="fa-solid fa-circle-question"></i> Pertanyaan Umum (FAQ)</h2>
            <p>Jawaban singkat seputar KRS dan KHS.</p>
        </div>

        <div class="faq-list">
            <div class="faq-item">
                <button type="button" class="faq-question">
                    Apa itu KRS?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>KRS (Kartu Rencana Studi) adalah daftar mata kuliah yang akan diambil mahasiswa pada satu semester. KRS harus diajukan dan disetujui sebelum perkuliahan dimulai.</p>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question">
                    Berapa maksimal SKS yang bisa diambil?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>Maksimal <strong>24 SKS</strong> per semester. Jumlah SKS dapat dipengaruhi oleh IP semester sebelumnya sesuai kebijakan akademik kampus.</p>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question">
                    Apakah KRS bisa diubah setelah diajukan?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>KRS dapat diubah selama masih dalam periode pengisian KRS dan status masih <em>Menunggu</em> atau <em>Ditolak</em>. Setelah disetujui, hubungi dosen wali untuk perubahan.</p>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question">
                    Apa arti status KRS (Menunggu, Disetujui, Ditolak)?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p><strong>Menunggu</strong> — pengajuan sedang direview dosen wali. <strong>Disetujui</strong> — KRS diterima dan mata kuliah terdaftar. <strong>Ditolak</strong> — pengajuan ditolak, Anda dapat mengajukan ulang mata kuliah lain.</p>
                </div>
            </div>

            <div class="faq-item">
                <button type="button" class="faq-question">
                    Apa itu KHS dan kapan nilai muncul?
                    <i class="fa-solid fa-chevron-down"></i>
                </button>
                <div class="faq-answer">
                    <p>KHS (Kartu Hasil Studi) berisi nilai mata kuliah yang sudah selesai. Nilai muncul setelah dosen menginput nilai dan admin memvalidasi data nilai.</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Tips --}}
    <div class="tips-panel">
        <div class="section-title">
            <h2><i class="fa-solid fa-lightbulb"></i> Tips Akademik</h2>
        </div>
        <div class="tips-grid">
            <div class="tip-card">
                <div class="tip-icon"><i class="fa-solid fa-clock"></i></div>
                <h4>Ajukan KRS Tepat Waktu</h4>
                <p>Isi KRS di awal periode pengisian agar ada waktu revisi jika ditolak dosen wali.</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon"><i class="fa-solid fa-list-check"></i></div>
                <h4>Cek Prasyarat Mata Kuliah</h4>
                <p>Pastikan mata kuliah prasyarat sudah lulus sebelum mendaftar mata kuliah lanjutan.</p>
            </div>
            <div class="tip-card">
                <div class="tip-icon"><i class="fa-solid fa-shield-halved"></i></div>
                <h4>Jaga Keamanan Akun</h4>
                <p>Ganti password secara berkala dan jangan bagikan akun login kepada orang lain.</p>
            </div>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="{{ asset('js/panduan.js') }}"></script>
@endpush
