@extends('layouts.dosen')

@section('content')
<div class="krs-container">

    <h2 class="krs-title">Validasi KRS</h2>

    <div class="krs-alert">
        Berikut daftar KRS mahasiswa pada kelas yang Anda ampu. Silahkan validasi sebelum masa perkuliahan dimulai.
    </div>

    <table class="krs-table">
        <thead>
            <tr>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>Kelas</th>
                <th>Jumlah Mahasiswa</th>
                <th>Validasi</th>
            </tr>
        </thead>

        <tbody>

        
            <tr>
                <td>IF2020</td>
                <td>Basis Data</td>
                <td>IF-A</td>
                <td>24</td>
                <td class="aksi-cell">
                    <button class="btn-validasi">Validasi KRS</button>
                    <span class="status success">Sudah Divalidasi</span>
                </td>
            </tr>

            <tr>
                <td>IF2021</td>
                <td>Pemrograman Web</td>
                <td>IF-B</td>
                <td>27</td>
                <td class="aksi-cell">
                    <button class="btn-validasi">Validasi KRS</button>
                    <span class="status pending">Menunggu</span>
                </td>
            </tr>

        </tbody>
    </table>

    <div class="krs-footer">
        Total Kelas: 4 | Total Mahasiswa: 96 | Menunggu Validasi: 17
    </div>

</div>
@endsection