<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BelanjaController;

// Route beranda (tabel belanja, statistik, search)
Route::get('/', [BelanjaController::class, 'index'])->name('belanja.index');

// Route tambah rencana belanja
Route::post('/belanja', [BelanjaController::class, 'store'])->name('belanja.store');

// Route hapus rencana belanja
Route::delete('/belanja/{id}', [BelanjaController::class, 'destroy'])->name('belanja.destroy');

// Route update status sudah dibeli
Route::patch('/belanja/{id}/status', [BelanjaController::class, 'updateStatus'])->name('belanja.updateStatus');

// Route pencarian (bisa juga pakai query di index)
Route::get('/cari', [BelanjaController::class, 'search'])->name('belanja.search');

// Route export laporan ke PDF
Route::get('/laporan/pdf', [BelanjaController::class, 'exportPdf'])->name('belanja.exportPdf');
