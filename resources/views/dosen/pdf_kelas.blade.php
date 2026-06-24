<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Kelas Dosen</title>

    <style>
        body{
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 30px;
        }

        .header{
            text-align:center;
            margin-bottom:20px;
        }

        .header h1{
            margin:0;
            font-size:22px;
        }

        .header h2{
            margin:5px 0;
            font-size:18px;
            font-weight:normal;
        }

        .info{
            margin-bottom:20px;
        }

        .info p{
            margin:4px 0;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        th{
            background:#dbeafe;
            border:1px solid #000;
            padding:10px;
            text-align:center;
        }

        td{
            border:1px solid #000;
            padding:8px;
            text-align:center;
        }

        .footer{
            margin-top:40px;
            text-align:right;
        }

        .footer p{
            margin:5px 0;
        }
    </style>
</head>
<body>

    <div class="header">
        <h1>POLITEKNIK NEGERI BATAM</h1>
        <h2>LAPORAN KELAS DOSEN</h2>
    </div>

    <div class="info">
        <p><strong>Tahun Akademik :</strong> 2025/2026 Genap</p>
        <p><strong>Tanggal Cetak :</strong> {{ date('d-m-Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode MK</th>
                <th>Mata Kuliah</th>
                <th>SKS</th>
                <th>Semester</th>
            </tr>
        </thead>

        <tbody>

            @foreach($matkul as $index => $m)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $m->kode_mk }}</td>
                <td>{{ $m->nama_mk }}</td>
                <td>{{ $m->sks }}</td>
                <td>{{ ucfirst($m->semester) }}</td>
            </tr>
            @endforeach

        </tbody>
    </table>

    <div class="footer">
        <p>Batam, {{ date('d-m-Y') }}</p>
        <br><br><br>
        <p><strong>Dosen Pengampu</strong></p>
    </div>

</body>
</html>