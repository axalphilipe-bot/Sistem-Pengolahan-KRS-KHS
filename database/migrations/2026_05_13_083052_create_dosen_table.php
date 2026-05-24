<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('dosen', function (Blueprint $table) {

            $table->string('nuptk',14)->primary();

            $table->string('nama',30);

            $table->string('email',30);

            $table->string('jabatan',10);

            $table->string('kode_prodi');

            $table->foreign('kode_prodi')
                  ->references('kode_prodi')
                  ->on('prodi');

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('dosen');
    }
};