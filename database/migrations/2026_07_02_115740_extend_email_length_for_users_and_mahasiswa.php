<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email', 100)->nullable()->change();
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('email', 100)->change();
            $table->string('nama', 50)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email', 30)->nullable()->change();
        });

        Schema::table('mahasiswa', function (Blueprint $table) {
            $table->string('email', 30)->change();
            $table->string('nama', 30)->change();
        });
    }
};
