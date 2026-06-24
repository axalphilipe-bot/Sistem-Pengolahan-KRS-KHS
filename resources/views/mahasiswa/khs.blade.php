@extends('layouts.mahasiswa')

@section('content')

<style>

.no-print{
    display:block;
}

.pdf-header{
    text-align:center;
    margin-bottom:20px;
}

</style>

<div class="krs-container">


    <div class="krs-header">
        <h2>KHS (Kartu Hasil Studi)</h2>
    </div>

    <div class="krs-filter">

        <div class="filter-item">
            <label>Semester</label>
            <select required>
                <option value="">-- Pilih Semester --</option>
                <option>Genap</option>
                <option>Ganjil</option>
            </select>
        </div>

        <div class="filter-item">
            <label>Tahun Ajaran            
            </label>
            <select required>
                <option value="">-- Tahun Ajaran --</option>
                <option>2025/2026</option>
                <option>2024/2025</option>
            </select>
        </div>

    </div>

    <div class="krs-table">
        <table>
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Angka</th>
                </tr>
            </thead>
            <tbody>

@foreach($nilai as $n)

<tr>
    <td>{{ $n->matkul->nama_mk }}</td>
    <td>{{ $n->matkul->sks }}</td>
    <td>{{ $n->nilai_huruf }}</td>
    <td>{{ $n->nilai_akhir }}</td>
</tr>

@endforeach

</tbody>
        </table>
    </div>

    <div class="krs-footer">
        <span>
    IP Semester: <b>{{ $ips }}</b> |
    IPK: <b>{{ $ips }}</b>
</span>
        <button class="btn ambil" id="openModal">Lihat KHS</button>
    </div>

</div>

<div id="khsModal" class="modal">

<div class="modal-content" id="pdfContent" style="background:#fff;color:#000;">

<div class="modal-header">

    <h2 style="text-align:center;margin-bottom:10px;">
        POLITEKNIK NEGERI BATAM
    </h2>

    <h3 style="text-align:center;">
        KARTU HASIL STUDI (KHS)
    </h3>

<span class="close no-print">&times;</span>

</div>
<div style="margin:20px 0;">

    <p>
        <strong>Nama :</strong>
        Ananda Shadiva Wansa
    </p>

    <p>
        <strong>NIM :</strong>
        3312511057
    </p>

    <p>
        <strong>Tahun Akademik :</strong>
        2025/2026 Genap
    </p>

</div>

<div class="khs-summary">
    <p><strong>Total SKS :</strong> {{ $totalSks }}</p>
    <p><strong>IP Semester :</strong> {{ $ips }}</p>
</div>
    
   <table class="modal-table">

    <thead>
        <tr>
            <th>Mata Kuliah</th>
            <th>SKS</th>
            <th>Nilai Huruf</th>
            <th>Nilai Akhir</th>
        </tr>
    </thead>

<tbody>
@foreach($nilai as $n)
<tr>
    <td>{{ $n->matkul->nama_mk }}</td>
    <td>{{ $n->matkul->sks }}</td>
    <td>{{ $n->nilai_huruf }}</td>
    <td>{{ $n->nilai_akhir }}</td>
</tr>
@endforeach
</tbody>

</table>

<div class="khs-actions no-print">

    <button
        class="btn pdf"
        onclick="exportPDF()">

        Export PDF

    </button>

</div>
        

    </div>

</div>
<script src="{{ asset('js/khs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

@endsection