<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function login(Request $request)
{
    $request->validate([
        'login' => 'required',
        'password' => 'required',
        'role' => 'required'
    ]);

    $role = $request->role;
    $login = $request->login;
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

        $user = User::where('email', $login)
            ->where('role', 'kps')
            ->first();

    } else {

        $user = User::where('email', $login)
            ->where('role', 'admin')
            ->first();
    }

    if ($user && Hash::check($password, $user->password)) {

        Auth::login($user);

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