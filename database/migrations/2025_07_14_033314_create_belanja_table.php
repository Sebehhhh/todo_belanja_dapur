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
        Schema::create('belanja', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang'); // Nama barang belanja
            $table->integer('jumlah_barang'); // Jumlah barang
            $table->timestamp('jam_simpan'); // Waktu rencana simpan
            $table->timestamp('jam_beli')->nullable(); // Waktu realisasi beli, nullable jika belum dibeli
            $table->boolean('status_sudah_dibeli')->default(false); // Status sudah dibeli/belum
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('belanja');
    }
};
