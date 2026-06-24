@extends('layouts.dosen')

@section('content')

<div class="krs-container">

    <div class="page-header">
        <h2>Validasi KRS Mahasiswa</h2>

        <p>
            Kelola pengajuan KRS mahasiswa yang mengambil mata kuliah yang Anda ampu.
        </p>
    </div>

    <!-- Statistik -->
    <div class="validasi-stats">

        <div class="validasi-card">
            <div class="validasi-icon blue-bg">
                <i class="fas fa-users"></i>
            </div>

            <div>
                <h3>{{ $krs->count() }}</h3>
                <p>Total Pengajuan</p>
            </div>
        </div>

        <div class="validasi-card">
            <div class="validasi-icon orange-bg">
                <i class="fas fa-hourglass-half"></i>
            </div>

            <div>
                <h3>{{ $krs->where('status','Pending')->count() }}</h3>
                <p>Pending</p>
            </div>
        </div>

        <div class="validasi-card">
            <div class="validasi-icon green-bg">
                <i class="fas fa-check-circle"></i>
            </div>

            <div>
                <h3>{{ $krs->where('status','Disetujui')->count() }}</h3>
                <p>Disetujui</p>
            </div>
        </div>

    </div>

    <!-- Tabel -->
    <div class="validasi-table-box">

        <table class="krs-table">

            <thead>
                <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>Mata Kuliah</th>
                    <th>Status</th>
                    <th width="220">Aksi</th>
                </tr>
            </thead>

            <tbody>

                @forelse($krs as $item)

                <tr>

                    <td>{{ $loop->iteration }}</td>

                    <td>{{ $item->nim }}</td>

                    <td>
                        {{ $item->mahasiswa->nama ?? '-' }}
                    </td>

                    <td>
                        {{ $item->mataKuliah->nama_mk ?? '-' }}
                    </td>

                    <td>

                        @if($item->status == 'Disetujui')

                            <span class="status success">
                                Disetujui
                            </span>

                        @elseif($item->status == 'Pending')

                            <span class="status pending">
                                Pending
                            </span>

                        @else

                            <span class="status reject">
                                Ditolak
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($item->status == 'Pending')

                            <a href="/dosen/krs/approve/{{ $item->id }}"
                               class="btn-validasi">
                                Approve
                            </a>

                            <a href="/dosen/krs/reject/{{ $item->id }}"
                               class="btn-tolak">
                                Reject
                            </a>

                        @elseif($item->status == 'Disetujui')

                            <span class="status success">
                                Sudah Disetujui
                            </span>

                        @else

                            <span class="status reject">
                                Ditolak
                            </span>

                        @endif

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="6">
                        Tidak ada data KRS
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <div class="krs-footer">
        Pastikan hanya mahasiswa yang memenuhi syarat yang disetujui.
    </div>

</div>

@endsection