@extends('layouts.app')

@section('content')

    <div class="krs-container">

        <div class="krs-header">
            <h2>Ambil KRS (Kartu Rencana Studi)</h2>

            <div class="krs-actions">
            </div>
        </div>

        <form method="GET" action="/krs">

            <div class="krs-filter">

                <div class="filter-item">
                    <label>Semester</label>
                    <select name="semester" required>
                        <option value="">-- Pilih Semester --</option>
                        <option value="ganjil">Ganjil</option>
                        <option value="genap">Genap</option>
                    </select>
                </div>

                <div class="filter-item">
                    <label>Prodi</label>
                    <select name="prodi" required>
                        <option value="">-- Pilih Prodi --</option>
                        <option value="informatika">Teknik Informatika</option>
                    </select>
                </div>

               <button type="submit" class="btn-tampilkan">Tampilkan</button>

            </div>

        </form>

        <div class="krs-alert">
            ⚠ Maksimal SKS yang dapat diambil adalah 24 SKS per semester.
            Pastikan tidak ada bentrok jadwal.
        </div>
        <div class="krs-table">
            <form method="POST" action="{{ route('krs.store') }}">
@csrf
            <table>
                <thead>
                    <tr>
                        <th>Kode Mata Kuliah</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Dosen Pengampu</th>
                        <th>Pilih</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($mataKuliah as $m)
                        <tr>
                            <td>{{ $m->kode }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->sks }}</td>
                            <td>{{ $m->dosen }}</td>
                            <td>
                                <span class="badge {{ $m->jenis == 'wajib' ? 'wajib' : 'pilihan' }}">
                                    {{ ucfirst($m->jenis) }}
                                </span>
                            </td>
                            <td>
                                <input type="checkbox" name="mata_kuliah[]" value="{{ $m->id }}" class="matkul"
                                    data-sks="{{ $m->sks }}">
                            </td>
                        </tr>
                        </form>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="krs-footer">
            <span>Total SKS diambil: <b><span id="total-sks">0</span>/24 SKS</b></span>
            <button class="btn-tampilkan">Ambil KRS</button>
        </div>

    </div>
    <script src="{{ asset('js/krs.js') }}"></script>
@endsection