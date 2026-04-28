
@extends('layouts.app')

@section('content')
<div class="kelas-container">

    <h2 class="title">Kelas Saya</h2>

    <!-- FILTER TOP -->
    <div class="top-filter">
        <select>
            <option>Cari Mata Kuliah...</option>
        </select>

        <div class="info-box">
            👥 Total Mahasiswa 96
        </div>

        <div class="info-box warning">
            ⏰ Menunggu Validasi: 17
        </div>
    </div>

    <!-- FILTER SECOND -->
    <div class="filter-bar">
        <input type="text" placeholder="Cari Mata Kuliah...">
        
        <select>
            <option>Filter Kelas</option>
        </select>

        <div class="right-tools">
            <button class="btn-outline">📘 2025/2026 Genap</button>
            <button class="btn-danger">📄 Export PDF</button>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-box">
        <table>
            <thead>
                <tr>
                    <th>Kode MK</th>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Kelas</th>
                    <th>Jadwal</th>
                    <th>Jumlah Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>IF2020</td>
                    <td>Basis Data</td>
                    <td>3</td>
                    <td>IF-A</td>
                    <td>Senin 18:00 - 20:30</td>
                    <td><span class="badge success">✔ Disetujui</span></td>
                    <td>
                        <button class="btn-blue">🔍 Lihat</button>
                        <button class="btn-green">✔ Validasi</button>
                    </td>
                </tr>

                <tr>
                    <td>IF2021</td>
                    <td>Pemograman Web</td>
                    <td>3</td>
                    <td>IF-B</td>
                    <td>Selasa 20:30 - 23:00</td>
                    <td><span class="badge warning">⏰ Pending</span></td>
                    <td>
                        <button class="btn-blue">🔍 Lihat</button>
                        <button class="btn-green">✔ Validasi</button>
                    </td>
                </tr>

                <tr>
                    <td>IF2022</td>
                    <td>Proyek Pembuatan Prototype</td>
                    <td>3</td>
                    <td>IF-C</td>
                    <td>Rabu 18:00 - 20:30</td>
                    <td><span class="badge success">✔ Disetujui</span></td>
                    <td>
                        <button class="btn-blue">🔍 Lihat</button>
                        <button class="btn-green">✔ Validasi</button>
                    </td>
                </tr>

                <tr>
                    <td>IF2023</td>
                    <td>Pemograman Berorientasi Objek</td>
                    <td>3</td>
                    <td>IF-D</td>
                    <td>Kamis 19:20 - 21:00</td>
                    <td><span class="badge warning">⏰ Pending</span></td>
                    <td>
                        <button class="btn-blue">🔍 Lihat</button>
                        <button class="btn-orange">📝 Nilai</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="table-footer">
        Total Kelas ditampilkan: 4 dari 4
    </div>

</div>
@endsection