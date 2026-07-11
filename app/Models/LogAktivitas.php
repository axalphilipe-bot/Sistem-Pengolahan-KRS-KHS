<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Auth;

class LogAktivitas extends Model
{
    protected $table = 'log_aktivitas';

    protected $fillable = [
        'user_id',
        'nama_pengguna',
        'role',
        'aktivitas',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static function catat(string $aktivitas, ?User $user = null): void
    {
        $user = $user ?? Auth::user();

        static::create([
            'user_id' => $user?->id,
            'nama_pengguna' => $user?->name ?? 'Sistem',
            'role' => $user?->role ?? 'sistem',
            'aktivitas' => $aktivitas,
        ]);
    }
}
