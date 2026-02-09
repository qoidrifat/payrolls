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
        Schema::create('konfigurasi_penggajians', function (Blueprint $table) {
            $table->id();
            $table->decimal('tax_percentage', 5, 2)->nullable(); // Persentase PPh 21
            $table->decimal('tarif_lembur_perjam', 5, 2)->nullable(); // Tarif lembur per jam
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('konfigurasi_penggajians');
    }
};
