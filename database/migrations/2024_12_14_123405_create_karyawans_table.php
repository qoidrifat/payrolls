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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique(); // Nomor Induk Karyawan
            $table->string('nama');
            $table->string('email')->unique()->nullable();
            $table->string('nomor_telepon')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('alamat')->nullable();
            $table->string('npwp')->nullable(); // Nomor Pokok Wajib Pajak
            $table->string('nomor_rekening_bank')->nullable();
            $table->string('department')->nullable(); // Departemen
            $table->string('position')->nullable(); // Jabatan
            $table->enum('status', ['Tetap', 'Kontrak', 'Harian'])->default('Tetap'); // Status karyawan
            $table->timestamps();
            $table->softDeletes(); // Untuk soft delete
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('karyawans');
    }
};
