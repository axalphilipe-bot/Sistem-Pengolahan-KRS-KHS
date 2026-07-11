<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('nilais')) {
            return;
        }

        if (Schema::hasColumn('nilais', 'id')) {
            return;
        }

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropPrimary(['nim']);
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->id()->first();
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->unique(['nim', 'kode_mk'], 'nilais_nim_kode_mk_unique');
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('nilais') || ! Schema::hasColumn('nilais', 'id')) {
            return;
        }

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropUnique('nilais_nim_kode_mk_unique');
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->dropColumn('id');
        });

        Schema::table('nilais', function (Blueprint $table) {
            $table->primary('nim');
        });
    }
};
