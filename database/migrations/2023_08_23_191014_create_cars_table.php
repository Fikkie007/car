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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // Jenis kendaraan (misal: angkutan orang, angkutan barang)
            $table->string('plate_number')->unique(); // Nomor plat kendaraan
            $table->integer('capacity'); // Kapasitas angkut kendaraan
            $table->year('manufacturing_year'); // Tahun pembuatan kendaraan
            $table->string('condition')->nullable(); // Kondisi kendaraan (misal: baik, perlu perawatan)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
