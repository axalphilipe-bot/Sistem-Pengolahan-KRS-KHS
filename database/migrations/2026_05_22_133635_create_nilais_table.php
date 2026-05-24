<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('nilais', function (Blueprint $table) {
           Schema::create('nilais', function (Blueprint $table) {

 

    $table->string('nim',10);

    $table->string('kode_mk',5);

    $table->integer('uts');

    $table->integer('harian');

    $table->integer('praktik');

    $table->integer('tugas');

    $table->integer('kehadiran');

    $table->double('nilai_akhir')->nullable();

    $table->string('nilai_huruf')->nullable();

    $table->double('index_nilai')->nullable();

    $table->timestamps();

});
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nilais');
    }
};
