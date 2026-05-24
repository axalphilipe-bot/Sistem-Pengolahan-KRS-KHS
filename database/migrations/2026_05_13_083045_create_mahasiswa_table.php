<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('mahasiswa', function (Blueprint $table) {

            $table->string('nim',10)->primary();

            $table->string('nama',30);
            $table->string('email',30);

            $table->string('kelas',10);
            $table->string('jenjang',2);

            $table->integer('semester');

            $table->string('kode_prodi');

            $table->foreign('kode_prodi')
                ->references('kode_prodi')
                ->on('prodi');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mahasiswa');
    }
};