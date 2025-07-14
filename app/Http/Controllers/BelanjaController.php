<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Belanja;
use Barryvdh\DomPDF\Facade\Pdf as FacadePdf;
use Barryvdh\DomPDF\Facades\Pdf;

class BelanjaController extends Controller
{
    /**
     * Menampilkan daftar rencana belanja, statistik, dan fitur pencarian.
     */
    public function index(Request $request)
    {
        // Ambil kata kunci pencarian dari request
        $search = $request->input('search');

        // Query data belanja, filter jika ada pencarian
        $query = Belanja::query();
        if ($search) {
            $query->where('nama_barang', 'like', '%' . $search . '%');
        }
        // Urutkan berdasarkan nama barang (alfabet)
        $belanja = $query->orderBy('nama_barang')->get();

        // Hitung statistik sederhana
        $sudahDibeli = $belanja->where('status_sudah_dibeli', true)->count();
        $belumDibeli = $belanja->where('status_sudah_dibeli', false)->count();

        // Kirim data ke view
        return view('beranda', [
            'belanja' => $belanja,
            'sudahDibeli' => $sudahDibeli,
            'belumDibeli' => $belumDibeli,
            'search' => $search,
        ]);
    }

    /**
     * Menyimpan data rencana belanja baru.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'jumlah_barang' => 'required|integer|min:1',
            'jam_simpan' => 'required|date_format:Y-m-d\TH:i',
        ]);

        // Simpan data ke database
        Belanja::create([
            'nama_barang' => $request->nama_barang,
            'jumlah_barang' => $request->jumlah_barang,
            'jam_simpan' => $request->jam_simpan,
            // jam_beli dan status_sudah_dibeli default null/false
        ]);

        // Redirect kembali ke beranda
        return redirect()->route('belanja.index')->with('success', 'Rencana belanja berhasil ditambahkan!');
    }

    /**
     * Menghapus data rencana belanja.
     */
    public function destroy($id)
    {
        $item = Belanja::findOrFail($id);
        $item->delete();
        return redirect()->route('belanja.index')->with('success', 'Data berhasil dihapus!');
    }

    /**
     * Mengubah status sudah dibeli (centang/uncentang checkbox).
     */
    public function updateStatus($id)
    {
        $item = Belanja::findOrFail($id);
        // Toggle status
        $item->status_sudah_dibeli = !$item->status_sudah_dibeli;
        // Jika dicentang, isi jam_beli dengan waktu sekarang
        if ($item->status_sudah_dibeli) {
            $item->jam_beli = now();
        } else {
            $item->jam_beli = null;
        }
        $item->save();
        return redirect()->route('belanja.index');
    }

    /**
     * Fitur pencarian barang (bisa juga pakai index dengan query search)
     */
    public function search(Request $request)
    {
        return $this->index($request);
    }

    /**
     * Export laporan pembelian ke PDF.
     */
    public function exportPdf()
    {
        // Ambil semua data belanja, urutkan nama
        $belanja = Belanja::orderBy('nama_barang')->get();
        // Render view khusus PDF
        $pdf = FacadePdf::loadView('laporan_pdf', ['belanja' => $belanja]);
        // Download file PDF
        return $pdf->download('laporan-belanja.pdf');
    }
}
