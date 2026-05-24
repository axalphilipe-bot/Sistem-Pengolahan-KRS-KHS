@extends('layouts.mahasiswa')

@section('content')

<div class="krs-container">

    <!-- HEADER -->
    <div class="krs-header">
        <h2>Ambil KRS (Kartu Rencana Studi)</h2>
    </div>

    <!-- FILTER -->
    <form method="GET" action="/krs">

        <div class="krs-filter">

            <!-- JENJANG -->
            <div class="filter-item">
                <label>Jenjang</label>

                <select name="jenjang">
                    <option value="">-- Pilih Jenjang --</option>
                    <option value="D3">D3</option>
                    <option value="D4">D4</option>
                    <option value="S2">S2</option>
                </select>
            </div>

            <!-- KELAS -->
            <div class="filter-item">
                <label>Kelas</label>

                <select name="kelas">
                    <option value="">-- Pilih Kelas --</option>
                    <option value="Pagi">Pagi</option>
                    <option value="Malam">Malam</option>
                    <option value="Batamindo">Batamindo</option>
                </select>
            </div>

            <!-- KELAS HURUF -->
            <div class="filter-item">
                <label>Kelas Huruf</label>

                <select name="kelas_huruf">
                    <option value="">-- Pilih Kelas Huruf --</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                </select>
            </div>

            <!-- SEMESTER -->
            <div class="filter-item">
                <label>Semester</label>

                <select name="semester">
                    <option value="">-- Pilih Semester --</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                </select>
            </div>

            <!-- PRODI -->
            <div class="filter-item">
                <label>Program Studi</label>

                <select name="prodi">
                    <option value="">-- Pilih Prodi --</option>
                    <option value="TI">Teknik Informatika</option>
                    <option value="TRPL">TRPL</option>
                    <option value="SI">Sistem Informasi</option>
                </select>
            </div>

        </div>

        <button type="submit" class="btn-tampilkan">
            Tampilkan Mata Kuliah
        </button>

    </form>

    <!-- ALERT -->
    <div class="krs-alert">
        ⚠ Maksimal SKS yang dapat diambil adalah 24 SKS per semester.
        Pastikan tidak ada bentrok jadwal.
    </div>

    <!-- FORM KRS -->
    <form method="POST" action="{{ route('krs.store') }}">

        @csrf

        <div class="krs-table">

            <table>

                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen Pengampu</th>
                        <th>Jenis</th>
                        <th>Pilih</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($mataKuliah as $m)

                    <tr>

                        <td>{{ $m->kode_mk }}</td>

                        <td>{{ $m->nama_mk }}</td>

                        <td>{{ $m->sks }}</td>

                        <td>{{ $m->dosen }}</td>

                        <td>
                            <span class="badge {{ $m->jenis == 'wajib' ? 'wajib' : 'pilihan' }}">
                                {{ ucfirst($m->jenis) }}
                            </span>
                        </td>

                        <td>
                            <input
                                type="checkbox"
                                name="mata_kuliah[]"
                                value="{{ $m->kode_mk }}"
                                class="matkul"
                                data-sks="{{ $m->sks }}"
                            >
                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

        <!-- FOOTER -->
        <div class="krs-footer">

            <span>
                Total SKS diambil:
                <b>
                    <span id="total-sks">0</span>/24 SKS
                </b>
            </span>

            <button type="submit" class="btn-tampilkan">
                Ambil KRS
            </button>

        </div>

    </form>

</div>

<script src="{{ asset('js/krs.js') }}"></script>

@endsection