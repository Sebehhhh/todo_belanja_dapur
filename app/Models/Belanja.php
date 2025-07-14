<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    // Daftar kolom yang boleh diisi secara massal
    protected $fillable = [
        'nama_barang', // Nama barang belanja
        'jumlah_barang', // Jumlah barang
        'jam_simpan', // Waktu rencana simpan
        'jam_beli', // Waktu realisasi beli
        'status_sudah_dibeli', // Status sudah dibeli/belum
    ];
    // Nama tabel yang digunakan model ini (harus didefinisikan jika tidak jamak/berbahasa Inggris)
    protected $table = 'belanja';
}
