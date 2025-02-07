<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Lelang</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2 style="text-align: center;">Laporan Lelang</h2>
    <table>
        <thead>
            <tr>
                <th>Barang</th>
                <th>Harga Akhir</th>
                <th>Kategori</th>
                <th>Pemenang</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($lelangs as $lelang)
                <tr>
                    <td>{{ $lelang->barang->nama_barang }}</td>
                    <td>Rp {{ number_format($lelang->harga_akhir, 0, ',', '.') }}</td>
                    <td>{{ $lelang->kategori->nama_kategori }}</td>
                    <td>{{ $lelang->masyarakat ? $lelang->masyarakat->nama_lengkap : '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
