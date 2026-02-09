
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
        Schema::create('penggajians', function (Blueprint $table) {
            $table->id();
            $table->foreignId('karyawan_id')->constrained('karyawans')->onDelete('cascade'); // Relasi ke tabel karyawan
            $table->date('tanggal_penggajian'); // Tanggal penggajian
            $table->decimal('gaji_pokok', 15, 2); // Gaji pokok
            $table->decimal('tunjangan', 15, 2)->nullable(); // Tunjangan
            $table->decimal('upah_lembur', 15, 2)->nullable(); // Upah lembur
            $table->decimal('bonus', 15, 2)->nullable(); // Bonus
            $table->decimal('potongan', 15, 2)->nullable(); // Potongan (misalnya PPh 21, BPJS)
            $table->decimal('gaji_bersih', 15, 2); // Gaji bersih
            $table->string('periode_penggajian'); // Periode penggajian (misalnya "Januari 2024")
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penggajians');
    }
};
