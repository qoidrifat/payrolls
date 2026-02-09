<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->unique();
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });

        // Modifikasi tabel karyawans untuk relasi
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropColumn('department'); // Hapus kolom department lama
            $table->foreignId('department_id')
                  ->nullable()
                  ->constrained('departments')
                  ->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('karyawans', function (Blueprint $table) {
            $table->dropConstrainedForeignId('department_id');
            $table->string('department')->nullable(); // Kembalikan kolom department lama jika diperlukan
        });

        Schema::dropIfExists('departments');
    }
};
