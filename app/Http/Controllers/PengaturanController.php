<?php

namespace App\Http\Controllers;

use App\Models\PengaturanSistem;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;

class PengaturanController extends Controller
{
    public function index()
    {
        $pengaturan = PengaturanSistem::current();

        return view('admin.pengaturan', compact('pengaturan'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'nama_sistem' => 'required|string|max:100',
            'nama_institusi' => 'required|string|max:150',
            'tahun_akademik' => 'required|string|max:20',
            'semester_aktif' => 'required|in:Ganjil,Genap',
            'maks_sks' => 'required|integer|min:1|max:24',
            'batas_krs' => 'nullable|date',
            'status_sistem' => 'required|in:aktif,maintenance',
        ]);

        $pengaturan = PengaturanSistem::current();
        $pengaturan->update($validated);

        LogAktivitas::catat('Memperbarui pengaturan sistem');

        return redirect('/admin/pengaturan')
            ->with('success', 'Pengaturan berhasil disimpan.');
    }
}
