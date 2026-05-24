<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        return back()->with('success', 'Profil berhasil diupdate');
    }
}   