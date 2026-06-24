@extends('layouts.dosen')

@section('content')
@if(session('success'))
<div class="alert-success">
    {{ session('success') }}
</div>
@endif

<div class="nilai-container">

    <div class="nilai-header">

        <h2>Input Nilai Perkuliahan</h2>

        <div class="info-box">
            <p>
                <b>Mata Kuliah:</b>
                {{ $matkul->nama_mk }}
                ({{ $matkul->sks }} SKS)
            </p>

            <p>
                <b>Semester:</b>
                {{ ucfirst($matkul->semester) }}
            </p>

            <p>
                <b>Dosen:</b>
                {{ $matkul->dosen }}
            </p>
        </div>

                <div class="bobot-box">

            <h4>Komposisi Nilai</h4>

            <p>
Aktif 15% • Proyek 35% • Tugas 10% • Kuis 10% • UTS 15% • UAS 15%
</p>

        </div>
        <div class="aksi-box">

            <a href="{{ route('nilai.template') }}" class="btn-excel">
                📥 Download Template
            </a>

            <form action="{{ route('nilai.import') }}"
      method="POST"
      enctype="multipart/form-data"
      id="formImport">

                @csrf

                <input type="hidden"
                       name="kode_mk"
                       value="{{ $matkul->kode_mk }}">

                <input type="file"
                       id="fileExcel"
                       name="file"
                       accept=".xlsx,.xls"
                       hidden>

                <label for="fileExcel" class="btn-pilih-file">
                    📄 Pilih File Excel
                </label>

                <span id="namaFile">
                    Belum ada file dipilih
                </span>

<button type="submit"
        class="btn-import"
        onclick="console.log('IMPORT DIKLIK')">
    📤 Import Excel
</button>

            </form>

                    <button type="button"
                class="btn-simpan-header"
                onclick="document.getElementById('formNilai').submit();">
             Simpan Nilai
        </button>

        </div>

    </div>

    <form id="formNilai"
          action="{{ route('nilai.simpan') }}"
          method="POST">

        @csrf

        <input type="hidden"
               name="kode_mk"
               value="{{ $matkul->kode_mk }}">

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
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($peserta as $no => $item)

@php
$m = $item->mahasiswa;
@endphp

                <tr>

                    <td>{{ $no + 1 }}</td>

                    <td>{{ $m->nim }}</td>

                    <td>{{ $m->nama }}</td>

                    <input type="hidden"
                           name="nim[]"
                           value="{{ $m->nim }}">

                    

                    <td>
                        <input type="number"
                               name="keaktifan[]"
                               value="{{ optional($m->nilai)->keaktifan }}">
                    </td>

                    <td>
                        <input type="number"
                               name="proyek[]"
                               value="{{ optional($m->nilai)->proyek }}">
                    </td>

                    <td>
                        <input type="number"
                               name="tugas[]"
                               value="{{ optional($m->nilai)->tugas }}">
                    </td>

                    <td>
                        <input type="number"
                               name="kuis[]"
                               value="{{ optional($m->nilai)->kuis }}">
                    </td>

                    <td>
                        <input type="number"
                               name="uts[]"
                               value="{{ optional($m->nilai)->uts }}">
                    </td>

                    <td>
                        <input type="number"
                               name="uas[]"
                               value="{{ optional($m->nilai)->uas }}">
                    </td>

                    <td>
                        <input type="text"
                               class="nilai-akhir"
                               value="{{ optional($m->nilai)->nilai_akhir }}"
                               readonly>
                    </td>

                    <td>
                        <input type="text"
                               class="nilai-huruf"
                               value="{{ optional($m->nilai)->nilai_huruf }}"
                               readonly>
                    </td>

                    <td>
                        <input type="text"
                               class="nilai-index"
                               value="{{ optional($m->nilai)->index_nilai }}"
                               readonly>
                    </td>

                    <td class="aksi-btn">

                    @if($m->nilai)
                    <a href="{{ route('nilai.hapus', $m->nilai->nim) }}"
                    class="btn-hapus"
                    onclick="return confirm('Yakin ingin menghapus nilai?')">
                        Hapus
                    </a>
                    @endif

                </td>

                </tr>

                @endforeach

            </tbody>

        </table>

    </form>

</div>

@endsection

<script>
document.addEventListener("input", function (e) {

    const row = e.target.closest("tr");

    if (!row) return;

    let keaktifan = parseFloat(row.querySelector('[name="keaktifan[]"]').value) || 0;
    let proyek = parseFloat(row.querySelector('[name="proyek[]"]').value) || 0;
    let tugas = parseFloat(row.querySelector('[name="tugas[]"]').value) || 0;
    let kuis = parseFloat(row.querySelector('[name="kuis[]"]').value) || 0;
    let uts = parseFloat(row.querySelector('[name="uts[]"]').value) || 0;
    let uas = parseFloat(row.querySelector('[name="uas[]"]').value) || 0;

    let hasil =
    (keaktifan * 0.15) +
    (proyek * 0.35) +
    (tugas * 0.10) +
    (kuis * 0.10) +
    (uts * 0.15) +
    (uas * 0.15);

    let huruf = "";
    let index = "";

    if (hasil >= 85) {
        huruf = "A";
        index = "4.00";
    } else if (hasil >= 80) {
        huruf = "A-";
        index = "3.75";
    } else if (hasil >= 75) {
        huruf = "B+";
        index = "3.50";
    } else if (hasil >= 70) {
        huruf = "B";
        index = "3.00";
    } else if (hasil >= 65) {
        huruf = "C+";
        index = "2.50";
    } else if (hasil >= 60) {
        huruf = "C";
        index = "2.00";
    } else if (hasil >= 50) {
        huruf = "D";
        index = "1.00";
    } else {
        huruf = "E";
        index = "0.00";
    }

    row.querySelector('.nilai-akhir').value = hasil.toFixed(2);
    row.querySelector('.nilai-huruf').value = huruf;
    row.querySelector('.nilai-index').value = index;
});

<script>
document.addEventListener('DOMContentLoaded', function () {

    const fileInput = document.getElementById('fileExcel');
    const namaFile = document.getElementById('namaFile');

    if (fileInput && namaFile) {

        fileInput.addEventListener('change', function () {

            namaFile.textContent =
                this.files.length > 0
                    ? this.files[0].name
                    : 'Belum ada file dipilih';

        });

    }

});
</script>
