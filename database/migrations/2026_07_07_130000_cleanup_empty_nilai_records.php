<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('nilais')
            ->where('status', 'Pending')
            ->where(function ($query) {
                $query->where('kunci_nilai', 0)->orWhereNull('kunci_nilai');
            })
            ->where('keaktifan', 0)
            ->where('proyek', 0)
            ->where('tugas', 0)
            ->where('kuis', 0)
            ->where('uts', 0)
            ->where('uas', 0)
            ->delete();
    }

    public function down(): void
    {
        // Data yang dihapus tidak dapat dipulihkan.
    }
};
