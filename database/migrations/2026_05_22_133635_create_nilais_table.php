<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {

            $table->id();

            $table->string('nim', 10);

            $table->string('kode_mk', 5);

            $table->integer('teamwork');
            $table->integer('keaktifan');
            $table->integer('laporan');

            $table->integer('proyek');

       
            $table->integer('tugas');
            $table->integer('kuis');

      
            $table->integer('uts');
            $table->integer('uas');

            $table->double('nilai_akhir')->nullable();

            $table->string('nilai_huruf')->nullable();

            $table->double('index_nilai')->nullable();

            $table->timestamps();

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};