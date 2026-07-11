@extends('layouts.admin')

@section('content')

<div class="admin-page pengguna-page">

    @if(session('success'))
        <div class="alert-success-custom">
            <i class="fa-solid fa-circle-check"></i>
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error-custom">
            <i class="fa-solid fa-circle-xmark"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- Hero --}}
    <div class="page-hero">
        <div class="page-hero-content">
            <span class="page-hero-badge">
                <i class="fa-solid fa-shield-halved"></i>
                Keamanan Sistem
            </span>
            <h1>
                <i class="fa-solid fa-users-gear"></i>
                Pengguna & Hak Akses
            </h1>
            <p>Kelola akun pengguna, role, dan status akses sistem KRS & KHS Politeknik Negeri Batam.</p>
        </div>

        <div class="page-hero-stat">
            <small>Total Pengguna</small>
            <strong>{{ $totalUser }}</strong>
        </div>
    </div>

    {{-- Mini stats --}}
    <div class="mini-stats mini-stats-4">
        <div class="mini-stat-card">
            <div class="mini-stat-icon blue">
                <i class="fa-solid fa-user-shield"></i>
            </div>
            <div class="mini-stat-info">
                <small>Admin</small>
                <strong>{{ $totalAdmin }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon green">
                <i class="fa-solid fa-chalkboard-user"></i>
            </div>
            <div class="mini-stat-info">
                <small>Dosen</small>
                <strong>{{ $totalDosen }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon orange">
                <i class="fa-solid fa-user-graduate"></i>
            </div>
            <div class="mini-stat-info">
                <small>Mahasiswa</small>
                <strong>{{ $totalMahasiswa }}</strong>
            </div>
        </div>

        <div class="mini-stat-card">
            <div class="mini-stat-icon purple">
                <i class="fa-solid fa-user-tie"></i>
            </div>
            <div class="mini-stat-info">
                <small>KPS</small>
                <strong>{{ $totalKps }}</strong>
            </div>
        </div>
    </div>

    {{-- Toolbar --}}
    <div class="panel-toolbar">
        <div class="toolbar-left">
            <a href="{{ route('admin.pengguna.create') }}" class="btn-primary-custom">
                <i class="fa-solid fa-plus"></i>
                Tambah Pengguna
            </a>
        </div>

        <form method="GET" action="{{ route('admin.pengguna.index') }}" class="search-form">
            <input
                type="text"
                name="search"
                class="search-modern"
                placeholder="Cari nama, email, NIM, NUPTK, role..."
                value="{{ $search ?? '' }}">
            <button type="submit" class="btn-search">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
        </form>
    </div>

    {{-- Tabel --}}
    <div class="data-table-panel">
        <div class="data-table-header">
            <h3><i class="fa-solid fa-table"></i> Daftar Pengguna</h3>
            <span class="result-info">
                Menampilkan <strong>{{ $users->firstItem() ?? 0 }}–{{ $users->lastItem() ?? 0 }}</strong>
                dari <strong>{{ $users->total() }}</strong> data
                @if($search)
                    untuk "<strong>{{ $search }}</strong>"
                @endif
            </span>
        </div>

        @if($users->isEmpty())
            <div class="empty-state">
                <i class="fa-solid fa-user-slash"></i>
                <h4>Tidak ada data pengguna</h4>
                <p>
                    @if($search)
                        Tidak ditemukan pengguna dengan kata kunci "{{ $search }}".
                    @else
                        Belum ada pengguna terdaftar. Tambahkan pengguna baru.
                    @endif
                </p>
                <a href="{{ route('admin.pengguna.create') }}" class="btn-primary-custom">
                    <i class="fa-solid fa-plus"></i>
                    Tambah Pengguna
                </a>
            </div>
        @else
            <div class="data-table-scroll">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Pengguna</th>
                            <th>Login</th>
                            <th>Role</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            @php
                                $loginId = match($user->role) {
                                    'mahasiswa' => $user->nim,
                                    'dosen' => $user->nuptk,
                                    default => $user->email,
                                };
                                $loginLabel = match($user->role) {
                                    'mahasiswa' => 'NIM',
                                    'dosen' => 'NUPTK',
                                    default => 'Email',
                                };
                            @endphp
                            <tr>
                                <td>{{ ($users->currentPage() - 1) * $users->perPage() + $loop->iteration }}</td>
                                <td>
                                    <div class="student-cell student-cell-plain">
                                        <div class="student-name">{{ $user->name }}</div>
                                        @if($user->email && $user->role !== 'admin' && $user->role !== 'kps')
                                            <div class="student-nim">{{ $user->email }}</div>
                                        @endif
                                    </div>
                                </td>
                                <td>
                                    <span class="login-tag">{{ $loginLabel }}</span>
                                    <div class="login-value">{{ $loginId ?? '–' }}</div>
                                </td>
                                <td>
                                    <span class="role-badge role-{{ $user->role }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td>
                                    @if(($user->status ?? 'aktif') === 'aktif')
                                        <span class="status-active">
                                            <i class="fa-solid fa-circle"></i>
                                            Aktif
                                        </span>
                                    @else
                                        <span class="status-inactive">
                                            <i class="fa-solid fa-circle"></i>
                                            Nonaktif
                                        </span>
                                    @endif
                                </td>
                                <td>
                                    <div class="action-group">
                                        <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="btn-icon btn-edit" title="Edit">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                        <a href="{{ route('admin.pengguna.destroy', $user->id) }}"
                                           class="btn-icon btn-delete"
                                           title="Hapus"
                                           onclick="return confirm('Yakin ingin menghapus pengguna ini?')">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-bar">
                <span class="pagination-info">
                    Halaman {{ $users->currentPage() }} dari {{ $users->lastPage() }}
                </span>
                <div class="pagination-wrapper">
                    {{ $users->onEachSide(1)->links() }}
                </div>
            </div>
        @endif
    </div>

</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var search = document.querySelector('.search-modern');
    if (!search) return;

    var timer;
    search.addEventListener('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(function () {
            search.form.submit();
        }, 400);
    });
});
</script>
@endpush

@endsection
