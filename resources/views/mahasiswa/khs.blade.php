@extends('layouts.mahasiswa')

@section('content')

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
                <tr>
                    <td>Basis Data</td>
                    <td>3</td>
                    <td>A</td>
                    <td class="grade-a">90</td>
                </tr>
                <tr>
                    <td>Pemograman Web</td>
                    <td>3</td>
                    <td>A</td>
                    <td class="grade-a">90</td>
                </tr>
                <tr>
                    <td>Proyek Pembuatan Prototype</td>
                    <td>3</td>
                    <td>A</td>
                    <td class="grade-b">90</td>
                </tr>
                <tr>
                    <td>Pemograman Berorientasi Objek</td>
                    <td>3</td>
                    <td>A</td>
                    <td class="grade-b">96</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="krs-footer">
        <span>IP Semester: <b>3.67</b> | IPK: <b>3.45</b></span>
        <button class="btn ambil" id="openModal">Lihat KHS</button>
    </div>

</div>

<div id="khsModal" class="modal">

    <div class="modal-content">

        <div class="modal-header">
            <h3>📊 Detail KHS</h3>
            <span class="close">&times;</span>
        </div>

   <table class="modal-table">
    <thead>
        <tr>
            <th>Mata Kuliah</th>
            <th>Nilai</th>
            <th>Angka</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Basis Data</td>
            <td>A</td>
            <td><span class="badge grade-a">90</span></td>
        </tr>
        <tr>
            <td>Pemograman Web</td>
            <td>A</td>
            <td><span class="badge grade-a">90</span></td>
        </tr>
         <tr>
            <td>Pemograman Web</td>
            <td>A</td>
            <td><span class="badge grade-a">95</span></td>
        </tr>
         <tr>
            <td>Pemograman Web</td>
            <td>A</td>
            <td><span class="badge grade-a">96</span></td>
        </tr>
    </tbody>
</table>

<div class="khs-actions">
    <button class="btn pdf" onclick="exportPDF()">Export PDF</button>
</div>
</tbody>
        </table>
        

    </div>

</div>
<script src="{{ asset('js/khs.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

@endsection