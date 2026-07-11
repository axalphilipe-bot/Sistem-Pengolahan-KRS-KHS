<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::forAuthenticatedUser();

        if ($mahasiswa) {
            $mahasiswa->load(['prodi', 'dosenWali']);
        }

        if (!$mahasiswa) {
            return redirect('/login')->with(
                'error',
                'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.'
            );
        }

        return view(
            'mahasiswa.profil',
            compact('mahasiswa')
        );
    }

    public function update(Request $request)
    {
        $mahasiswa = Mahasiswa::forAuthenticatedUser();

        if (!$mahasiswa) {
            return redirect('/login')->with(
                'error',
                'Data mahasiswa tidak ditemukan. Silakan hubungi administrator.'
            );
        }

        $request->validate([
            'name'  => 'required|string|max:50',
            'email' => 'required|email|max:100',
            'no_hp' => 'nullable|string|max:20',
        ]);

        $mahasiswa->update([
            'nama'  => $request->name,
            'email' => $request->email,
        ]);

        $user = auth()->user();

        if ($user) {
            $user->update([
                'name'  => $request->name,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password'      => 'required',
            'new_password'      => 'required|min:6',
            'confirm_password'  => 'required|same:new_password',
        ]);

        $user = auth()->user();

        if (!$user) {
            return redirect('/login');
        }

        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}
