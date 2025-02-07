<x-dashboard.layout :$title>
    <div class="w-full p-8">
        <h2 class="mb-6 font-semibold">Data Lelang</h2>
        <a href="/dashboard/lelang/create"
            class="mb-6 inline-block rounded bg-primary-500 px-4 py-2 font-semibold text-white shadow hover:bg-primary-600">Tambah
            Barang</a>
        @if (session('success'))
            <div class="mb-6 block rounded bg-green-500 bg-opacity-50 px-4 py-2 shadow font-medium">
                {{ session('success') }}
            </div>
        @endif
        <table class="mb-4 table w-full table-auto border-collapse">
            <thead>
                <th>Tanggal Lelang</th>
                <th>Tanggal Tutup Lelang</th>
                <th>Harga Terkini / Akhir</th>
                <th>Penawar Terbaru / Pemenang</th>
                <th>Petugas</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($lelangs as $lelang)
                    <tr>
                        <td>{{ $lelang->tanggal_lelang }}</td>
                        <td>{{ $lelang->tanggal_tutup_lelang }}</td>
                        <td>Rp {{ number_format($lelang->harga_akhir, 0, ',', '.') }}</td>
                        <td>{{ $lelang->masyarakat->nama_lengkap ?? '-' }}</td>
                        <td>{{ $lelang->petugas->nama_petugas }}</td>
                        <td>{{ $lelang->kategori->nama_kategori }}</td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <a href="/dashboard/lelang/update/{{ $lelang->id }}"
                                    class="inline-block rounded bg-yellow-500 px-4 py-2 font-semibold text-white shadow hover:bg-yellow-600">Ubah</a>
                                <form action="/dashboard/lelang/delete/{{ $lelang->id }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="confirm('Apakah anda yakin ingin menghapus lelang ini?')"
                                        class="inline-block rounded bg-red-500 px-4 py-2 font-semibold text-white shadow hover:bg-red-600">Hapus</button>
                            </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $lelangs->links() }}
    </div>
</x-dashboard.layout>
