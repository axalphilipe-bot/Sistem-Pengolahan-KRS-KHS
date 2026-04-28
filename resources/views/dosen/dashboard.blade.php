@extends('layouts.app')

@section('content')

    <div class="dosen-container">
        <div class="dosen-header">
            <h2>Selamat Datang, {{ auth()->user()->name }}</h2>
            <p>Kelola kelas dan KRS mahasiswa dengan mudah.</p>
        </div>

        <div class="dosen-cards">

            <div class="card">
                <h3>{{ $jumlahKelas }}</h3>
                <p>Jumlah Kelas</p>
            </div>

            <div class="card">
                <h3>{{ $totalMahasiswa }}</h3>
                <p>Total Mahasiswa</p>
            </div>

            <div class="card">
                <h3>{{ $krsDisetujui }}</h3>
                <p>KRS Disetujui</p>
            </div>

            <div class="card">
                <h3>{{ $menunggu }}</h3>
                <p>Menunggu Persetujuan</p>
            </div>

        </div>

        <div class="table-box">

            <h3>Daftar Kelas Pengampu</h3>

            <table>
                <thead>
                    <tr>
                        <th>Kode MK</th>
                        <th>Mata Kuliah</th>
                        <th>SKS</th>
                        <th>Semester</th>
                        <th>Jumlah Mahasiswa</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($matkul as $m)
                        <tr>
                            <td>{{ $m->kode }}</td>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->sks }}</td>
                            <td>{{ $m->semester }}</td>
                            <td>24</td> <!-- nanti dari DB -->
                            <td>
                                <a href="/dosen/kelas/{{ $m->kode }}" class="btn lihat">Lihat KRS</a>
                                <a href="/dosen/nilai/{{ $m->kode }}" class="btn nilai">Input Nilai</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>

        </div>

        <div class="alert-box">
            ⚠ Pastikan KRS mahasiswa telah disetujui sebelum perkuliahan dimulai.
        </div>

    </div>

@endsection