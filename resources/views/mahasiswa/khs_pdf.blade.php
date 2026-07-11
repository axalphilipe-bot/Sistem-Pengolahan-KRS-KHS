<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>KHS {{ $mahasiswa->nim ?? '' }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DejaVu Serif', 'Times New Roman', Times, serif;
            font-size: 11pt;
            color: #000;
            line-height: 1.4;
            padding: 28px 32px;
        }

        .header {
            text-align: center;
            margin-bottom: 18px;
        }

        .header .institution {
            font-size: 14pt;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .header .address {
            font-size: 10pt;
            margin-top: 4px;
        }

        .divider {
            border-top: 2px solid #000;
            margin: 14px 0 16px;
        }

        .header .title {
            font-size: 12pt;
            font-weight: bold;
            text-decoration: underline;
        }

        .header .period {
            font-size: 10pt;
            margin-top: 8px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
            font-size: 10.5pt;
        }

        .info-table td {
            padding: 3px 0;
            vertical-align: top;
        }

        .info-table .label {
            width: 100px;
        }

        .info-table .colon {
            width: 14px;
        }

        .info-table .value {
            width: 42%;
            padding-right: 12px;
        }

        .grade-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 14px;
            font-size: 10.5pt;
        }

        .grade-table th,
        .grade-table td {
            border: 1px solid #000;
            padding: 7px 6px;
        }

        .grade-table th {
            background: #f0f0f0;
            font-weight: bold;
            text-align: center;
            font-size: 10pt;
        }

        .grade-table td {
            vertical-align: middle;
        }

        .grade-table .center {
            text-align: center;
        }

        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
            font-size: 10pt;
        }

        .summary-table td {
            border: 1px solid #000;
            padding: 8px 6px;
            width: 33.33%;
            vertical-align: middle;
        }

        .footer-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 36px;
            font-size: 10.5pt;
        }

        .footer-table td {
            vertical-align: top;
            width: 50%;
        }

        .signature {
            text-align: center;
        }

        .signature .role {
            margin-top: 4px;
        }

        .sign-space {
            height: 60px;
        }

        .empty-row {
            text-align: center;
            font-style: italic;
            color: #555;
            padding: 16px !important;
        }
    </style>
</head>
<body>

    <div class="header">
        <p class="institution">Politeknik Negeri Batam</p>
        <p class="address">Batam, Kepulauan Riau</p>
        <div class="divider"></div>
        <p class="title">KARTU HASIL STUDI (KHS)</p>
        <p class="period">Tahun Akademik 2025/2026 &mdash; Semester Genap</p>
    </div>

    <table class="info-table">
        <tr>
            <td class="label">Nama</td>
            <td class="colon">:</td>
            <td class="value">{{ $mahasiswa->nama ?? '-' }}</td>
            <td class="label">NIM</td>
            <td class="colon">:</td>
            <td class="value">{{ $mahasiswa->nim ?? '-' }}</td>
        </tr>
        <tr>
            <td class="label">Program Studi</td>
            <td class="colon">:</td>
            <td class="value">{{ $mahasiswa->prodi->nama_prodi ?? '-' }}</td>
            <td class="label">Semester</td>
            <td class="colon">:</td>
            <td class="value">{{ $mahasiswa->semester ?? '-' }}</td>
        </tr>
    </table>

    <table class="grade-table">
        <thead>
            <tr>
                <th style="width: 6%;">No</th>
                <th style="width: 44%;">Mata Kuliah</th>
                <th style="width: 10%;">SKS</th>
                <th style="width: 18%;">Nilai Huruf</th>
                <th style="width: 22%;">Nilai Angka</th>
            </tr>
        </thead>
        <tbody>
            @forelse($nilai as $index => $n)
                <tr>
                    <td class="center">{{ $index + 1 }}</td>
                    <td>{{ $n->matkul->nama_mk ?? '-' }}</td>
                    <td class="center">{{ $n->matkul->sks ?? 0 }}</td>
                    <td class="center">{{ $n->nilai_huruf ?? '-' }}</td>
                    <td class="center">{{ number_format($n->nilai_akhir ?? 0, 1) }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="empty-row">Tidak ada data nilai.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <table class="summary-table">
        <tr>
            <td><strong>Total SKS</strong> : {{ $totalSks }}</td>
            <td><strong>IPS</strong> : {{ number_format($ips, 2) }}</td>
            <td><strong>IPK</strong> : {{ number_format($ipk, 2) }}</td>
        </tr>
    </table>

    <table class="footer-table">
        <tr>
            <td>
                Batam, {{ now()->locale('id')->translatedFormat('d F Y') }}
            </td>
            <td class="signature">
                <p>Mengetahui,</p>
                <p class="role">Kepala Program Studi</p>
                <div class="sign-space"></div>
                <p>(___________________________)</p>
            </td>
        </tr>
    </table>

</body>
</html>
