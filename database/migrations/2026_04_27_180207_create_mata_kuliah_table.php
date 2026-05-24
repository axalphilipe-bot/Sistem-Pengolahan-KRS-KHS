<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('mata_kuliahs', function (Blueprint $table) {
            $table->string('kode_mk')->primary();
            $table->string('nama_mk', 100);
            $table->unsignedTinyInteger('sks');
            $table->string('dosen')->nullable();
            $table->string('kode_prodi'); 
            $table->enum('semester', ['ganjil', 'genap']);
            $table->enum('jenis', ['wajib', 'pilihan']);
            $table->timestamps();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('mata_kuliah');
    }
};
