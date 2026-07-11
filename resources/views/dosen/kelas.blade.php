
@extends('layouts.dosen')

@section('content')
<div class="kelas-container">

    <h2 class="title">Kelas Saya</h2>

    <div class="top-filter">
        <div class="info-box">
    <i class="fas fa-users"></i>
    Total Mahasiswa {{ $totalMahasiswa }}
</div>

        <div class="info-box warning">
    <i class="fas fa-clock"></i>
    Menunggu Validasi: {{ $menunggu }}
</div>
    </div>

    <!-- FILTER SECOND -->
    <div class="filter-bar">
        <input type="text" placeholder="Cari Mata Kuliah...">

        <div class="right-tools">
            <button class="btn-outline">
    <i class="fas fa-calendar-alt"></i>
    2025/2026 Genap
</button>
            <a href="{{ route('dosen.export.pdf') }}" class="btn-export">
    <i class="fas fa-file-pdf"></i>
    Export PDF
</a>
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
                    <th>Jumlah Mahasiswa</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

@forelse($matkul as $m)
<tr>

    <td>{{ $m->kode_mk }}</td>

    <td>{{ $m->nama_mk }}</td>

    <td>{{ $m->sks }}</td>

    <td>{{ $m->jumlah_mahasiswa }}</td>

    <td>

        <a href="/dosen/kelas/{{ $m->kode_mk }}"
   class="btn-detail">
    <i class="fas fa-eye"></i>
    Detail
</a>

<a href="/dosen/nilai/{{ $m->kode_mk }}"
   class="btn-nilai-soft">
    <i class="fas fa-pen"></i>
    Nilai
</a>

    </td>

</tr>

@empty
<tr>
    <td colspan="5">Belum ada mata kuliah yang Anda ampu.</td>
</tr>
@endforelse

</tbody>
        </table>
    </div>

    <!-- FOOTER -->
   <div class="table-footer">
    Total Kelas ditampilkan: {{ $jumlahKelas }} dari {{ $jumlahKelas }}
</div>

</div>
@endsection