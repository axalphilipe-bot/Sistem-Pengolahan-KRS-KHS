<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\LogAktivitas;

class AuthController extends Controller
{
    public function showLogin()
    {
        return response()
            ->view('login')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate')
            ->header('Pragma', 'no-cache');
    }

    public function login(Request $request)
{
    $request->validate([
        'login' => 'required',
        'password' => 'required',
        'role' => 'required'
    ]);

    $role = $request->role;
    $login = trim($request->login);
    $password = $request->password;

    if ($role == 'mahasiswa') {

        $user = User::where('nim', $login)
            ->where('role', 'mahasiswa')
            ->first();

    } elseif ($role == 'dosen') {

        $user = User::where('nuptk', $login)
            ->where('role', 'dosen')
            ->first();

    } elseif ($role == 'kps') {

        $user = User::whereRaw('LOWER(email) = ?', [strtolower($login)])
            ->where('role', 'kps')
            ->first();

    } else {

        $user = User::whereRaw('LOWER(email) = ?', [strtolower($login)])
            ->where('role', 'admin')
            ->first();
    }

    if ($user && Hash::check($password, $user->password)) {

        Auth::login($user);

        LogAktivitas::catat('Login ke sistem', $user);

        if ($user->role == 'admin') {
            return redirect('/admin');
        }

        if ($user->role == 'dosen') {
            return redirect('/dosen');
        }

        
        if ($user->role == 'kps') {
            return redirect('/kps');
        }

        return redirect('/home');
    }

    return back()->with('error', 'Login gagal');
}
}