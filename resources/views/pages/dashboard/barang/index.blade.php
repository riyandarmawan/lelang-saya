<x-dashboard.layout :$title>
    <div class="w-full p-8">
        <h2 class="mb-6 font-semibold">Data Barang</h2>
        <a href="/dashboard/barang/create"
            class="mb-6 inline-block rounded bg-primary-500 px-4 py-2 font-semibold text-white shadow hover:bg-primary-600">Tambah
            Barang</a>
        @if (session('success'))
            <div class="mb-6 block rounded bg-green-500 bg-opacity-50 px-4 py-2 shadow font-medium">
                {{ session('success') }}
            </div>
        @endif
        <table class="mb-4 table w-full table-auto border-collapse">
            <thead>
                <th>Nama Barang</th>
                <th>Tanggal</th>
                <th>Harga Awal</th>
                <th>Kategori</th>
                <th>Aksi</th>
            </thead>
            <tbody>
                @foreach ($barangs as $barang)
                    <tr>
                        <td>{{ $barang->nama_barang }}</td>
                        <td>{{ $barang->tanggal }}</td>
                        <td>Rp {{ number_format($barang->harga_awal, 0, ',', '.') }}</td>
                        <td>
                            <div class="flex items-center justify-center gap-2">
                                <a href="/dashboard/barang/update/{{ $barang->id }}"
                                    class="inline-block rounded bg-yellow-500 px-4 py-2 font-semibold text-white shadow hover:bg-yellow-600">Ubah</a>
                                <form action="/dashboard/barang/delete/{{ $barang->id }}" method="POST">
                                    @csrf
                                    <button type="submit"
                                        onclick="confirm('Apakah anda yakin ingin menghapus barang ini?')"
                                        class="inline-block rounded bg-red-500 px-4 py-2 font-semibold text-white shadow hover:bg-red-600">Hapus</button>
                            </div>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $barangs->links() }}
    </div>
</x-dashboard.layout>
