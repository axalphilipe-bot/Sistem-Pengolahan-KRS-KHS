<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            if (! Schema::hasColumn('nilais', 'status')) {
                $table->string('status', 20)->default('Pending')->after('index_nilai');
            }

            if (! Schema::hasColumn('nilais', 'kunci_nilai')) {
                $table->boolean('kunci_nilai')->default(false)->after('status');
            }

            if (! Schema::hasColumn('nilais', 'tanggal_kunci')) {
                $table->timestamp('tanggal_kunci')->nullable()->after('kunci_nilai');
            }
        });
    }

    public function down(): void
    {
        Schema::table('nilais', function (Blueprint $table) {
            if (Schema::hasColumn('nilais', 'tanggal_kunci')) {
                $table->dropColumn('tanggal_kunci');
            }

            if (Schema::hasColumn('nilais', 'kunci_nilai')) {
                $table->dropColumn('kunci_nilai');
            }

            if (Schema::hasColumn('nilais', 'status')) {
                $table->dropColumn('status');
            }
        });
    }
};
