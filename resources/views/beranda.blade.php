{{--
    Halaman beranda utama aplikasi To Do Belanja Dapur.
    Menampilkan statistik, form tambah, pencarian, dan tabel rencana belanja.
    Setiap proses CRUD dan tampilan diberi komentar agar mudah dipahami pemula.
--}}
@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Statistik sederhana --}}
    <div class="row mb-4">
        <div class="col-md-6">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Sudah Dibeli</h5>
                    <p class="card-text display-6">{{ $sudahDibeli }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Belum Dibeli</h5>
                    <p class="card-text display-6">{{ $belumDibeli }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Form tambah rencana belanja --}}
    <div class="card mb-4">
        <div class="card-header">Tambah Rencana Belanja</div>
        <div class="card-body">
            <form action="{{ route('belanja.store') }}" method="POST">
                @csrf
                <div class="row g-2 align-items-end">
                    <div class="col-md-4">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <label for="jumlah_barang" class="form-label">Jumlah</label>
                        <input type="number" name="jumlah_barang" id="jumlah_barang" class="form-control" min="1" required>
                    </div>
                    <div class="col-md-3">
                        <label for="jam_simpan" class="form-label">Jam Simpan</label>
                        <input type="datetime-local" name="jam_simpan" id="jam_simpan" class="form-control" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- Form pencarian --}}
    <form action="{{ route('belanja.index') }}" method="GET" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari nama barang..." value="{{ $search }}">
            <button class="btn btn-outline-secondary" type="submit">Cari</button>
        </div>
    </form>

    {{-- Tombol export PDF --}}
    <div class="mb-3">
        <a href="{{ route('belanja.exportPdf') }}" class="btn btn-outline-success">Export PDF</a>
    </div>

    {{-- Tabel rencana belanja --}}
    <div class="card">
        <div class="card-header">Daftar Rencana Belanja</div>
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Centang</th>
                        <th>Nama Barang</th>
                        <th>Jumlah</th>
                        <th>Jam Simpan</th>
                        <th>Jam Beli</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- Loop data belanja --}}
                    @forelse ($belanja as $item)
                        <tr>
                            <td>
                                {{-- Form update status sudah dibeli --}}
                                <form action="{{ route('belanja.updateStatus', $item->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="checkbox" onchange="this.form.submit()" {{ $item->status_sudah_dibeli ? 'checked' : '' }}>
                                </form>
                            </td>
                            <td>
                                {{-- Nama barang dicoret jika sudah dibeli --}}
                                <span @if($item->status_sudah_dibeli) style="text-decoration: line-through;" @endif>
                                    {{ $item->nama_barang }}
                                </span>
                            </td>
                            <td>{{ $item->jumlah_barang }}</td>
                            <td>{{ \Carbon\Carbon::parse($item->jam_simpan)->format('d-m-Y H:i') }}</td>
                            <td>
                                @if($item->jam_beli)
                                    {{ \Carbon\Carbon::parse($item->jam_beli)->format('d-m-Y H:i') }}
                                @else
                                    -
                                @endif
                            </td>
                            <td>
                                {{-- Form hapus data --}}
                                <form action="{{ route('belanja.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Belum ada data rencana belanja.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 