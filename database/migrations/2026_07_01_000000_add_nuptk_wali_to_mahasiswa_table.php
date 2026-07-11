<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('nuptk_wali', 14)->nullable()->after('kode_prodi');

            $table->foreign('nuptk_wali')
                ->references('nuptk')
                ->on('dosen')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->dropForeign(['nuptk_wali']);
            $table->dropColumn('nuptk_wali');
        });
    }
};
