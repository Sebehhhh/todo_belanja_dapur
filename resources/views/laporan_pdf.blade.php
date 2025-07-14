{{--
    View untuk export laporan belanja ke PDF.
    Menampilkan tabel data belanja yang sudah dan belum dibeli.
--}}
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Belanja Dapur</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 6px; text-align: left; }
        th { background: #eee; }
        .coret { text-decoration: line-through; }
    </style>
</head>
<body>
    <h2>Laporan Belanja Dapur</h2>
    <table>
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Jam Simpan</th>
                <th>Jam Beli</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($belanja as $item)
                <tr>
                    <td class="{{ $item->status_sudah_dibeli ? 'coret' : '' }}">{{ $item->nama_barang }}</td>
                    <td>{{ $item->jumlah_barang }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->jam_simpan)->format('d-m-Y H:i') }}</td>
                    <td>
                        @if($item->jam_beli)
                            {{ \Carbon\Carbon::parse($item->jam_beli)->format('d-m-Y H:i') }}
                        @else
                            -
                        @endif
                    </td>
                    <td>{{ $item->status_sudah_dibeli ? 'Sudah Dibeli' : 'Belum' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html> 