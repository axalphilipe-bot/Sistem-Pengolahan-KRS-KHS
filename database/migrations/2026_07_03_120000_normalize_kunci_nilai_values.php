<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('nilais')
            ->whereIn(DB::raw('CAST(kunci_nilai AS CHAR)'), ['Terkunci', 'Sudah Terkunci', '1'])
            ->update(['kunci_nilai' => 1]);

        DB::table('nilais')
            ->whereIn(DB::raw('CAST(kunci_nilai AS CHAR)'), ['Belum Terkunci', '0'])
            ->orWhereNull('kunci_nilai')
            ->update(['kunci_nilai' => 0]);
    }

    public function down(): void
    {
        // Tidak dikembalikan — data legacy tidak perlu di-restore.
    }
};
