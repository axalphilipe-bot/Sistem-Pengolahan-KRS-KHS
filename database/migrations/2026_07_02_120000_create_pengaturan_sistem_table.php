<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengaturan_sistem', function (Blueprint $table) {
            $table->id();
            $table->string('nama_sistem', 100)->default('Sistem KRS & KHS');
            $table->string('nama_institusi', 150)->default('Politeknik Negeri Batam');
            $table->string('tahun_akademik', 20)->default('2025/2026');
            $table->string('semester_aktif', 20)->default('Genap');
            $table->unsignedTinyInteger('maks_sks')->default(24);
            $table->date('batas_krs')->nullable();
            $table->string('status_sistem', 20)->default('aktif');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengaturan_sistem');
    }
};
