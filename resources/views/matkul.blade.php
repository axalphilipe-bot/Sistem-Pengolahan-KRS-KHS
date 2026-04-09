@extends('layouts.app')

@section('content')

<div class="container-jadwal">

    <h2>Jadwal Kuliah</h2>

    <!-- Filter -->
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

        <div class="action-btn">
            <button class="btn-export">📄 Export PDF</button>
        </div>
    </div>

    <!-- Card -->
    <div class="card-jadwal">
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode MK</th>
                    <th>Mata Kuliah - hari - Jam</th>
                    <th>Dosen</th>
                    <th>SKS</th>
                    <th>Disetujui</th>
                </tr>
            </thead>
            <tbody>
                 <tr class="hari">
                    <td rowspan="7">Senin</td>
                    <td>17:10 - 18:00</td>
                    <td>-</td>
                    <td>-</td>
                    <td>-</td>
                </tr>


            </tbody>
        </table>

        <!-- Footer -->
        <div class="footer-jadwal">
            <div>
                <strong>Total Mata Kuliah:</strong> 5 <br>
                <strong>Total SKS:</strong> 15
            </div>

            <button class="btn-detail">Lihat Detail</button>
        </div>
    </div>

</div>

@endsection