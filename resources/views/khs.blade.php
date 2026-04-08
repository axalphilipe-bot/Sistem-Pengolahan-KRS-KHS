@extends('layouts.app')

@section('content')

<div class="krs-container">

    <!-- HEADER -->
    <div class="krs-header">
        <h2>KHS (Kartu Hasil Studi)</h2>

        <div class="krs-actions">
            <button class="btn pdf">Export PDF</button>
        </div>
    </div>

    <!-- FILTER -->
    <div class="krs-filter">

        <div class="filter-item">
            <label>Semester</label>
            <select required>
                <option value="">-- Pilih Semester --</option>
                <option>2025/2026 Genap</option>
            </select>
        </div>

        <div class="filter-item">
            <label>Jurusan</label>
            <select required>
                <option value="">-- Pilih Jurusan --</option>
                <option>Teknik Informatika</option>
            </select>
        </div>

    </div>

    <!-- TABLE -->
    <div class="krs-table">
        <table>
            <thead>
                <tr>
                    <th>Mata Kuliah</th>
                    <th>SKS</th>
                    <th>Nilai</th>
                    <th>Grade</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Basis Data</td>
                    <td>3</td>
                    <td>90</td>
                    <td class="grade-a">A</td>
                </tr>
                <tr>
                    <td>Pemograman Web</td>
                    <td>3</td>
                    <td>85</td>
                    <td class="grade-a">A</td>
                </tr>
                <tr>
                    <td>Proyek Pembuatan Prototype</td>
                    <td>3</td>
                    <td>80</td>
                    <td class="grade-b">B+</td>
                </tr>
                <tr>
                    <td>Pemograman Berorientasi Objek</td>
                    <td>3</td>
                    <td>79</td>
                    <td class="grade-b">B+</td>
                </tr>
            </tbody>
        </table>
    </div>

    <!-- FOOTER -->
    <div class="krs-footer">
        <span>IP Semester: <b>3.67</b> | IPK: <b>3.45</b></span>
        <button class="btn ambil" id="openModal">Lihat KHS</button>
    </div>

</div>
<!-- POPUP -->
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
                    <th>Grade</th>
                </tr>
            </thead>
         <tbody>
    <tr>
        <td>Basis Data</td>
        <td>90</td>
        <td><span class="badge grade-a">A</span></td>
    </tr>
    <tr>
        <td>Pemograman Web</td>
        <td>85</td>
        <td><span class="badge grade-a">A</span></td>
    </tr>
    <tr>
        <td>Proyek Pembuatan Prototype</td>
        <td>80</td>
        <td><span class="badge grade-b">B+</span></td>
    </tr>
    <tr>
        <td>Pemograman Berorientasi Objekdd</td>
        <td>79</td>
        <td><span class="badge grade-b">B+</span></td>
    </tr>
</tbody>
        </table>

    </div>

</div>
<script src="{{ asset('js/khs.js') }}"></script>
@endsection