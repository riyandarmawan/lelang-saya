<x-dashboard.layout :$title>
    <div class="p-6">
        <h2 class="text-2xl font-semibold text-gray-700">Laporan Lelang</h2>

        <!-- Table -->
        <div class="mt-6 overflow-x-auto">
            <table class="w-full border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border">Barang</th>
                        <th class="p-3 border">Harga Akhir</th>
                        <th class="p-3 border">Kategori</th>
                        <th class="p-3 border">Pemenang</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lelangs->where('tanggal_tutup_lelang', '<', now()) as $lelang)
                        <tr class="border">
                            <td class="p-3">{{ $lelang->barang->nama_barang }}</td>
                            <td class="p-3">Rp {{ number_format($lelang->harga_akhir, 0, ',', '.') }}</td>
                            <td class="p-3">{{ $lelang->kategori->nama_kategori }}</td>
                            <td class="p-3">{{ $lelang->masyarakat ? $lelang->masyarakat->nama_lengkap : '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Export Buttons -->
        <div class="mt-4 flex gap-4">
            <a href="/dashboard/laporan/exports/pdf" class="bg-red-500 text-white px-4 py-2 rounded-lg">Export PDF</a>
        </div>
    </div>
</x-dashboard.layout>
