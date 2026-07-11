@extends('layouts.admin')

@section('content')

<div class="admin-page pengaturan-page">

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Hero --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="page-hero-badge">
                <i class="fa-solid fa-gear"></i>
                Konfigurasi
            </span>
            <h1>
                <i class="fa-solid fa-sliders"></i>
                Pengaturan
            </h1>
            <p>Kelola pengaturan umum sistem KRS & KHS Politeknik Negeri Batam.</p>
        </div>

        <div class="page-hero-stat">
            <small>Status Sistem</small>
            <strong>{{ $pengaturan->status_sistem === 'aktif' ? 'Aktif' : 'Maintenance' }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats mini-stats-3">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-calendar"></i>
            </div>
            <div class="mini-stat-info">
                <small>Tahun Aktif</small>
                <strong>{{ $pengaturan->tahun_akademik }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-layer-group"></i>
            </div>
            <div class="mini-stat-info">
                <small>Maks SKS</small>
                <strong>{{ $pengaturan->maks_sks }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-book-open"></i>
            </div>
            <div class="mini-stat-info">
                <small>Semester</small>
                <strong>{{ $pengaturan->semester_aktif }}</strong>
            </div>
        </div>
    </div>

    {{-- Form --}}
    <div class="form-card form-card-wide">
        <div class="form-header">
            <h1>Pengaturan Umum Sistem</h1>
            <p>Perbarui informasi institusi, tahun akademik, batas KRS, dan status sistem.</p>
        </div>

        <form action="{{ route('admin.pengaturan.update') }}" method="POST" class="admin-form">
            @csrf

            <div class="form-section-title">Informasi Institusi</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="nama_sistem">Nama Sistem</label>
                    <input type="text" id="nama_sistem" name="nama_sistem"
                           value="{{ old('nama_sistem', $pengaturan->nama_sistem) }}" required>
                    @error('nama_sistem')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="nama_institusi">Nama Institusi</label>
                    <input type="text" id="nama_institusi" name="nama_institusi"
                           value="{{ old('nama_institusi', $pengaturan->nama_institusi) }}" required>
                    @error('nama_institusi')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-section-title">Akademik</div>
            <div class="form-grid form-grid-akademik">
                <div class="form-field">
                    <label for="tahun_akademik">Tahun Akademik Aktif</label>
                    <input type="text" id="tahun_akademik" name="tahun_akademik"
                           value="{{ old('tahun_akademik', $pengaturan->tahun_akademik) }}"
                           placeholder="2025/2026" required>
                    @error('tahun_akademik')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="semester_aktif">Semester Aktif</label>
                    <select id="semester_aktif" name="semester_aktif" required>
                        <option value="Ganjil" @selected(old('semester_aktif', $pengaturan->semester_aktif) == 'Ganjil')>Ganjil</option>
                        <option value="Genap" @selected(old('semester_aktif', $pengaturan->semester_aktif) == 'Genap')>Genap</option>
                    </select>
                    @error('semester_aktif')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="maks_sks">Maksimal SKS per Semester</label>
                    <input type="number" id="maks_sks" name="maks_sks" min="1" max="24" step="1"
                           value="{{ old('maks_sks', $pengaturan->maks_sks) }}" required>
                    <span class="field-hint">Minimal 1 · Maksimal 24 SKS</span>
                    @error('maks_sks')<span class="field-error">{{ $message }}</span>@enderror
                </div>

                <div class="form-field">
                    <label for="batas_krs">Batas Akhir Pengajuan KRS</label>
                    <input type="date" id="batas_krs" name="batas_krs"
                           value="{{ old('batas_krs', $pengaturan->batas_krs?->format('Y-m-d')) }}">
                    @error('batas_krs')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-section-title">Sistem</div>
            <div class="form-grid">
                <div class="form-field">
                    <label for="status_sistem">Status Sistem</label>
                    <select id="status_sistem" name="status_sistem" required>
                        <option value="aktif" @selected(old('status_sistem', $pengaturan->status_sistem) == 'aktif')>Aktif</option>
                        <option value="maintenance" @selected(old('status_sistem', $pengaturan->status_sistem) == 'maintenance')>Maintenance</option>
                    </select>
                    @error('status_sistem')<span class="field-error">{{ $message }}</span>@enderror
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-form-submit">Simpan Pengaturan</button>
            </div>
        </form>
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var input = document.getElementById('maks_sks');
    if (!input) return;

    var MIN = 1;
    var MAX = 24;

    function clampMaksSks() {
        if (input.value === '') return;

        var value = parseInt(input.value, 10);
        if (Number.isNaN(value) || value < MIN) {
            input.value = MIN;
        } else if (value > MAX) {
            input.value = MAX;
        }
    }

    input.addEventListener('input', clampMaksSks);
    input.addEventListener('change', clampMaksSks);

    input.addEventListener('keydown', function (event) {
        if (event.key !== 'ArrowUp' && event.key !== 'ArrowDown') return;

        var value = parseInt(input.value, 10);
        if (Number.isNaN(value)) return;

        if (event.key === 'ArrowUp' && value >= MAX) {
            event.preventDefault();
        }

        if (event.key === 'ArrowDown' && value <= MIN) {
            event.preventDefault();
        }
    });

    input.addEventListener('wheel', function (event) {
        event.preventDefault();
    }, { passive: false });

    clampMaksSks();
});
</script>
@endpush

@endsection
