<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
{
    $user = auth()->user();

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'no_hp' => $request->no_hp,
        'alamat' => $request->alamat,
    ]);

    return back()->with('success', 'Profil berhasil diupdate');
}

    public function updatePassword(Request $request)
    {
        if ($request->new_password != $request->confirm_password) {
            return back()->with('error', 'Password tidak sama');
        }

        return back()->with('success', 'Password berhasil diubah');
    }
}