<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next, $role)
{
    if (!auth()->check()) {
        return redirect('/login')
            ->with('error', 'Silakan login terlebih dahulu.');
    }

    if (auth()->user()->role != $role) {
        $home = match (auth()->user()->role) {
            'admin' => '/admin',
            'dosen' => '/dosen',
            'kps' => '/kps',
            'mahasiswa' => '/home',
            default => '/login',
        };

        return redirect($home)
            ->with('error', 'Akses ditolak. Halaman ini khusus untuk role ' . $role . '.');
    }

    return $next($request);
}
}
