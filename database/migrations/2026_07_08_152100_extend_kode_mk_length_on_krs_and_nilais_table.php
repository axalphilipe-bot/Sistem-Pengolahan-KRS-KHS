<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->string('kode_mk', 10)->change();
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->string('kode_mk', 10)->change();
        });
    }

    public function down(): void
    {
        Schema::table('krs', function (Blueprint $table) {
            $table->string('kode_mk', 5)->change();
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->string('kode_mk', 5)->change();
        });
    }
};
