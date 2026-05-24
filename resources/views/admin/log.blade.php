@extends('layouts.admin')

@section('content')

<div class="page-content">

    <h1 class="page-title">Log Aktivitas</h1>

    <p class="page-subtitle">
        Riwayat aktivitas pengguna dalam sistem
    </p>

    <div class="table-wrappe">

        <table class="custom-table">

            <thead>
                <tr>
                    <th>Waktu</th>
                    <th>Pengguna</th>
                    <th>Aktivitas</th>
                </tr>
            </thead>

            <tbody>

                <tr>
                    <td>14 Mei 2025 10:30</td>
                    <td>Admin</td>
                    <td>Menyetujui KRS</td>
                </tr>

                <tr>
                    <td>14 Mei 2025 12:30</td>
                    <td>Hilda Widyastuti, S.T., M.T.</td>
                    <td>Input Nilai</td>
                </tr>

                <tr>
                    <td>16 Mei 2025 14:30</td>
                    <td>Admin</td>
                    <td>Login ke sistem</td>
                </tr>

              
                @for($i = 0; $i < 5; $i++)
                <tr>
                    <td>&nbsp;</td>
                    <td></td>
                    <td></td>
                </tr>
                @endfor

            </tbody>

        </table>

    </div>

</div>

@endsection