@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Persetujuan KRS</h1>

    <p class="page-subtitle">
        Setujui atau tolak pengajuan KRS Mahasiswa
    </p>

    <!-- FILTER -->
    <div class="filter-wrapper">

        <!-- SEARCH -->
        <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>

            <input type="text"
            placeholder="Cari NIM atau Nama Mahasiswa...">
        </div>

        <!-- SELECT -->
        <select class="filter-status">
            <option>Semua Status</option>
            <option>Pending</option>
            <option>Disetujui</option>
            <option>Ditolak</option>
        </select>

    </div>

    <!-- TABLE -->
    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Semester</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

@foreach($krs as $item)

<tr>

    <td>{{ $item->nim }}</td>

    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>

    <td>{{ $item->mahasiswa->semester ?? '-' }}</td>

    <td>
    {{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}
</td>

    <td>

@if($item->status == 'Pending')

    <span class="status pending">
        Pending
    </span>

@elseif($item->status == 'Disetujui')

    <span class="status approved">
        Disetujui
    </span>

@else

    <span class="status rejected">
        Ditolak
    </span>

@endif

</td>

<td class="aksi">

@if($item->status == 'Pending')

    <a href="/admin/krs/setujui/{{ $item->id }}"
       class="btn-setuju">
       Setujui
    </a>

    <a href="/admin/krs/tolak/{{ $item->id }}"
       class="btn-tolak">
       Tolak
    </a>

@else

    <a href="/admin/krs/{{ $item->nim }}"
       class="btn-lihat">
       Detail
    </a>

@endif

</td>

</tr>

@endforeach

</tbody>

        </table>

    </div>

</div>

@endsection