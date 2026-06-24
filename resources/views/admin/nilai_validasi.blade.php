@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Validasi Nilai</h1>

    <p class="page-subtitle">
        Validasi nilai yang sudah diinput
    </p>
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
@endif

    <form method="GET" action="/admin/validasi" class="filter-wrapper">

    <div class="search-box">
        <i class="fa-solid fa-magnifying-glass"></i>

        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari NIM atau Nama Mahasiswa...">
    </div>

    <select
        name="status"
        class="filter-select"
        onchange="this.form.submit()">

        <option value="">Semua Status</option>

        <option value="Menunggu Approval"
            {{ request('status') == 'Menunggu Approval' ? 'selected' : '' }}>
            Menunggu Approval
        </option>

        <option value="Disetujui"
            {{ request('status') == 'Disetujui' ? 'selected' : '' }}>
            Disetujui
        </option>

        <option value="Ditolak"
            {{ request('status') == 'Ditolak' ? 'selected' : '' }}>
            Ditolak
        </option>

    </select>

</form>

    <div class="table-wrapper">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Nilai</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>

                @foreach($nilai as $item)

                <tr>
                    <td>{{ $item->nim }}</td>
                    <td>{{ $item->mahasiswa->nama ?? '-' }}</td>
                    <td>{{ $item->kode_mk }}</td>
                    <td>{{ $item->nilai_huruf }}</td>
                    <td>

@if($item->status == 'Disetujui')

    <span class="status-disetujui">
        Disetujui
    </span>

@elseif($item->status == 'Ditolak')

    <span class="status-ditolak">
        Ditolak
    </span>

@else

    <span class="status-menunggu">
        Menunggu Approval
    </span>

@endif

</td>

                    <td>

                        @if($item->status == 'Menunggu Approval')

                            <a href="/admin/validasi/setujui/{{ $item->nim }}"
   class="btn-setujui"
   onclick="return confirm('Setujui nilai ini?')">
    Setujui
</a>

                            <a href="/admin/validasi/tolak/{{ $item->nim }}"
   class="btn-tolak"
   onclick="return confirm('Apakah Anda yakin ingin menolak nilai ini?')">
    Tolak
</a>

                        @else

                            -

                        @endif

                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>

    </div>

</div>

@endsection