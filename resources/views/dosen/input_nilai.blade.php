@extends('layouts.dosen')

@section('content')

@if(session('success'))
    <div class="nilai-alert nilai-alert-success">
        <i class="fa-solid fa-circle-check"></i>
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="nilai-alert nilai-alert-error">
        <i class="fa-solid fa-circle-xmark"></i>
        {{ session('error') }}
    </div>
@endif

<div class="dosen-dashboard dosen-input-nilai">

    <div class="detail-top-bar">
        <a href="/dosen/nilai" class="detail-back-link">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Daftar Mata Kuliah
        </a>
    </div>

    <div class="nilai-page-hero">
        <div class="nilai-page-hero-content">
            <span class="nilai-page-badge">
                <i class="fa-solid fa-pen-to-square"></i>
                Input Nilai
            </span>
            <h1>{{ $matkul->nama_mk }}</h1>
            <p>Masukkan komponen nilai mahasiswa. Nilai akhir, huruf, dan index dihitung otomatis.</p>
        </div>
        <div class="nilai-page-hero-meta">
            <small>Kode MK</small>
            <strong>{{ $matkul->kode_mk }}</strong>
        </div>
    </div>

    <div class="nilai-info-grid">
        <div class="nilai-info-card">
            <span class="nilai-info-label">Mata Kuliah</span>
            <strong>{{ $matkul->nama_mk }}</strong>
            <small>{{ $matkul->sks }} SKS</small>
        </div>
        <div class="nilai-info-card">
            <span class="nilai-info-label">Semester</span>
            <strong>{{ ucfirst($matkul->semester) }}</strong>
        </div>
        <div class="nilai-info-card">
            <span class="nilai-info-label">Dosen Pengampu</span>
            <strong>{{ $matkul->dosen }}</strong>
        </div>
        <div class="nilai-info-card nilai-info-bobot">
            <span class="nilai-info-label">Komposisi Nilai</span>
            <p>Aktif 15% · Proyek 35% · Tugas 10% · Kuis 10% · UTS 15% · UAS 15%</p>
        </div>
    </div>

    @if($allNilaiLocked ?? false)
        <div class="nilai-alert nilai-alert-error">
            <i class="fa-solid fa-lock"></i>
            Nilai telah dikunci oleh KPS.
        </div>
    @elseif($hasLockedNilai ?? false)
        <div class="nilai-alert nilai-alert-error">
            <i class="fa-solid fa-lock"></i>
            Sebagian nilai mahasiswa telah dikunci oleh KPS dan tidak dapat diubah.
        </div>
    @endif

    <div class="nilai-toolbar">
        <div class="nilai-toolbar-left">
            @if($allNilaiLocked ?? false)
                <span class="nilai-btn nilai-btn-template is-disabled">
                    <i class="fa-solid fa-file-arrow-down"></i>
                    Download Template
                </span>
            @else
                <a href="{{ route('nilai.template') }}" class="nilai-btn nilai-btn-template">
                    <i class="fa-solid fa-file-arrow-down"></i>
                    Download Template
                </a>
            @endif
        </div>

        <form action="{{ route('nilai.import') }}"
              method="POST"
              enctype="multipart/form-data"
              id="formImport"
              class="nilai-import-form">

            @csrf
            <input type="hidden" name="kode_mk" value="{{ $matkul->kode_mk }}">

            @unless($hasLockedNilai ?? false)
                <input type="file" id="fileExcel" name="file" accept=".xlsx,.xls" hidden>
            @endunless

            <label for="fileExcel" class="nilai-btn nilai-btn-file {{ ($hasLockedNilai ?? false) ? 'is-disabled' : '' }}">
                <i class="fa-solid fa-file-excel"></i>
                Pilih File Excel
            </label>

            <span id="namaFile" class="nilai-file-name">Belum ada file dipilih</span>

            <button type="submit" class="nilai-btn nilai-btn-import" @if($hasLockedNilai ?? false) disabled @endif>
                <i class="fa-solid fa-file-import"></i>
                Import Excel
            </button>
        </form>
    </div>

    <div class="nilai-table-panel">
        <div class="nilai-table-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Nilai Mahasiswa</h3>
            <span class="nilai-table-count">{{ $peserta->count() }} mahasiswa</span>
        </div>

        <form id="formNilai" action="{{ route('nilai.simpan') }}" method="POST"
              @if($allNilaiLocked ?? false) data-form-locked="1" @endif>
            @csrf
            <input type="hidden" name="kode_mk" value="{{ $matkul->kode_mk }}">

            <div class="nilai-table-scroll">
                <table class="nilai-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama Mahasiswa</th>
                            <th>Aktif</th>
                            <th>Proyek</th>
                            <th>Tugas</th>
                            <th>Kuis</th>
                            <th>UTS</th>
                            <th>UAS</th>
                            <th>Nilai Akhir</th>
                            <th>Huruf</th>
                            <th>Index</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($peserta as $no => $item)
                            @php
                                $m = $item->mahasiswa;
                                $nilai = $item->nilaiMk;
                                $rowLocked = ($allNilaiLocked ?? false) || ($nilai?->isLocked() ?? false);
                                $rowSaved = $nilai !== null;
                            @endphp
                            <tr>
                                <td>{{ $no + 1 }}</td>
                                <td>
                                    {{ $m->nim }}
                                    <input type="hidden" name="nim[]" value="{{ $m->nim }}">
                                </td>
                                <td class="nilai-col-name">{{ $m->nama }}</td>
                                <td>
                                    <input type="number" class="nilai-input" name="keaktifan[]"
                                           value="{{ $nilai->keaktifan ?? '' }}"
                                           min="0" max="100" step="0.01"
                                           @if($rowLocked) data-locked="1" @endif
                                           @if($rowLocked || ($rowSaved && $isSaved)) readonly @endif>
                                </td>
                                <td>
                                    <input type="number" class="nilai-input" name="proyek[]"
                                           value="{{ $nilai->proyek ?? '' }}"
                                           min="0" max="100" step="0.01"
                                           @if($rowLocked) data-locked="1" @endif
                                           @if($rowLocked || ($rowSaved && $isSaved)) readonly @endif>
                                </td>
                                <td>
                                    <input type="number" class="nilai-input" name="tugas[]"
                                           value="{{ $nilai->tugas ?? '' }}"
                                           min="0" max="100" step="0.01"
                                           @if($rowLocked) data-locked="1" @endif
                                           @if($rowLocked || ($rowSaved && $isSaved)) readonly @endif>
                                </td>
                                <td>
                                    <input type="number" class="nilai-input" name="kuis[]"
                                           value="{{ $nilai->kuis ?? '' }}"
                                           min="0" max="100" step="0.01"
                                           @if($rowLocked) data-locked="1" @endif
                                           @if($rowLocked || ($rowSaved && $isSaved)) readonly @endif>
                                </td>
                                <td>
                                    <input type="number" class="nilai-input" name="uts[]"
                                           value="{{ $nilai->uts ?? '' }}"
                                           min="0" max="100" step="0.01"
                                           @if($rowLocked) data-locked="1" @endif
                                           @if($rowLocked || ($rowSaved && $isSaved)) readonly @endif>
                                </td>
                                <td>
                                    <input type="number" class="nilai-input" name="uas[]"
                                           value="{{ $nilai->uas ?? '' }}"
                                           min="0" max="100" step="0.01"
                                           @if($rowLocked) data-locked="1" @endif
                                           @if($rowLocked || ($rowSaved && $isSaved)) readonly @endif>
                                </td>
                                <td>
                                    <input type="text" class="nilai-result nilai-akhir"
                                           value="{{ $nilai->nilai_akhir ?? '' }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="nilai-result nilai-huruf"
                                           value="{{ $nilai->nilai_huruf ?? '' }}" readonly>
                                </td>
                                <td>
                                    <input type="text" class="nilai-result nilai-index"
                                           value="{{ $nilai->index_nilai ?? '' }}" readonly>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="nilai-form-footer">
                <p class="nilai-form-hint">
                    <i class="fa-solid fa-circle-info"></i>
                    @if($allNilaiLocked ?? false)
                        Nilai telah dikunci oleh KPS.
                    @elseif($isSaved)
                        Nilai tersimpan. Klik <strong>Edit Nilai</strong> untuk mengubah, lalu <strong>Simpan Perubahan</strong>.
                    @else
                        Isi komponen nilai lalu klik <strong>Simpan Nilai</strong>. Baris kosong tidak ikut disimpan.
                    @endif
                </p>
                @unless($allNilaiLocked ?? false)
                <button type="button"
                        id="btnNilaiAction"
                        class="nilai-btn nilai-btn-submit"
                        data-mode="{{ $isSaved ? 'view' : 'create' }}">
                    <i class="fa-solid fa-floppy-disk"></i>
                    {{ $isSaved ? 'Edit Nilai' : 'Simpan Nilai' }}
                </button>
                @endunless
            </div>
        </form>
    </div>

</div>

@endsection

@push('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    const formNilai = document.getElementById("formNilai");
    const btnAction = document.getElementById("btnNilaiAction");
    const scoreInputs = document.querySelectorAll(".nilai-input");
    const formLocked = formNilai?.dataset.formLocked === "1";

    function setInputsEditable(editable) {
        scoreInputs.forEach(function (input) {
            if (formLocked || input.dataset.locked === "1") {
                input.setAttribute("readonly", "readonly");
                return;
            }

            if (editable) {
                input.removeAttribute("readonly");
            } else {
                input.setAttribute("readonly", "readonly");
            }
        });
    }

    function setSubmitMode(mode) {
        if (!btnAction) return;

        btnAction.dataset.mode = mode;

        if (mode === "view") {
            btnAction.innerHTML = '<i class="fa-solid fa-pen-to-square"></i> Edit Nilai';
            btnAction.classList.remove("is-save");
            btnAction.classList.add("is-edit");
        } else {
            btnAction.innerHTML = '<i class="fa-solid fa-floppy-disk"></i> ' +
                (mode === "create" ? "Simpan Nilai" : "Simpan Perubahan");
            btnAction.classList.remove("is-edit");
            btnAction.classList.add("is-save");
        }
    }

    if (formLocked) {
        setInputsEditable(false);
    }

    if (btnAction && !formLocked) {
        if (btnAction.dataset.mode === "create") {
            btnAction.classList.add("is-save");
        } else {
            btnAction.classList.add("is-edit");
        }

        btnAction.addEventListener("click", function () {
            const mode = btnAction.dataset.mode;

            if (mode === "create" || mode === "edit") {
                formNilai.submit();
                return;
            }

            if (mode === "view") {
                setInputsEditable(true);
                setSubmitMode("edit");
            }
        });
    }

    document.addEventListener("input", function (e) {
        if (!e.target.classList.contains("nilai-input")) return;

        const row = e.target.closest("tr");
        if (!row) return;

        updateRowCalculation(row);
    });

    function rowHasInput(row) {
        return Array.from(row.querySelectorAll(".nilai-input")).some(function (input) {
            return input.value.trim() !== "";
        });
    }

    function updateRowCalculation(row) {
        const akhirField = row.querySelector(".nilai-akhir");
        const hurufField = row.querySelector(".nilai-huruf");
        const indexField = row.querySelector(".nilai-index");

        if (!rowHasInput(row)) {
            akhirField.value = "";
            hurufField.value = "";
            indexField.value = "";
            return;
        }

        let keaktifan = parseFloat(row.querySelector('[name="keaktifan[]"]').value) || 0;
        let proyek    = parseFloat(row.querySelector('[name="proyek[]"]').value) || 0;
        let tugas     = parseFloat(row.querySelector('[name="tugas[]"]').value) || 0;
        let kuis      = parseFloat(row.querySelector('[name="kuis[]"]').value) || 0;
        let uts       = parseFloat(row.querySelector('[name="uts[]"]').value) || 0;
        let uas       = parseFloat(row.querySelector('[name="uas[]"]').value) || 0;

        let hasil =
            (keaktifan * 0.15) +
            (proyek * 0.35) +
            (tugas * 0.10) +
            (kuis * 0.10) +
            (uts * 0.15) +
            (uas * 0.15);

        let huruf = "";
        let index = "";

        if (hasil >= 85) { huruf = "A"; index = "4.00"; }
        else if (hasil >= 80) { huruf = "A-"; index = "3.75"; }
        else if (hasil >= 75) { huruf = "B+"; index = "3.50"; }
        else if (hasil >= 70) { huruf = "B"; index = "3.00"; }
        else if (hasil >= 65) { huruf = "C+"; index = "2.50"; }
        else if (hasil >= 60) { huruf = "C"; index = "2.00"; }
        else if (hasil >= 50) { huruf = "D"; index = "1.00"; }
        else { huruf = "E"; index = "0.00"; }

        akhirField.value = hasil.toFixed(2);
        hurufField.value = huruf;
        indexField.value = index;
    }

    const fileInput = document.getElementById("fileExcel");
    const namaFile = document.getElementById("namaFile");

    if (fileInput && namaFile) {
        fileInput.addEventListener("change", function () {
            namaFile.textContent = this.files.length > 0
                ? this.files[0].name
                : "Belum ada file dipilih";
        });
    }

});
</script>
@endpush
