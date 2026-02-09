<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('absensis', function (Blueprint $table) {
            // Tambahkan kolom foto_absensi setelah kolom existing
            $table->string('foto_absensi')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('absensis', function (Blueprint $table) {
            // Hapus kolom jika rollback
            $table->dropColumn('foto_absensi');
        });
    }
};
