<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 100)->change();
        });

        Schema::table('dosen', function (Blueprint $table) {
            $table->string('nama', 100)->change();
            $table->string('email', 100)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name', 30)->change();
        });

        Schema::table('dosen', function (Blueprint $table) {
            $table->string('nama', 30)->change();
            $table->string('email', 30)->change();
        });
    }
};
