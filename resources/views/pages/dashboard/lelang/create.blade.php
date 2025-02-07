<x-dashboard.layout :$title>
    <div class="flex h-full items-center justify-center p-8">
        <div class="w-full max-w-md rounded-lg border border-primary-950 bg-white p-6 shadow-lg">
            <h3 class="mb-4 text-center font-semibold text-primary-500">Tambah Lelang</h3>
            <form action="" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="id_barang" class="block font-medium text-gray-700">Barang</label>
                    <select id="id_barang" name="id_barang"
                        class="@error('id_barang') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                        @foreach ($barangs as $barang)
                            <option {{ old('id_barang') == $barang->id ? 'selected' : '' }} value="{{ $barang->id }}">{{ $barang->nama_barang }}</option>
                        @endforeach
                    </select>
                    @error('id_barang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_lelang" class="block font-medium text-gray-700">Tanggal Lelang</label>
                    <input type="date" value="{{ date('Y-m-d') }}" id="tanggal_lelang" name="tanggal_lelang" value="{{ old('tanggal_lelang') }}"
                        class="@error('tanggal_lelang') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                    @error('tanggal_lelang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal_tutup_lelang" class="block font-medium text-gray-700">Tanggal Tutup Lelang</label>
                    <input type="date" value="{{ date('Y-m-d') }}" id="tanggal_tutup_lelang" name="tanggal_tutup_lelang" value="{{ old('tanggal_tutup_lelang') }}"
                        class="@error('tanggal_tutup_lelang') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                    @error('tanggal_tutup_lelang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="id_kategori" class="block font-medium text-gray-700">Kategori</label>
                    <select id="id_kategori" name="id_kategori"
                        class="@error('id_kategori') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                        @foreach ($kategoris as $kategori)
                            <option {{ old('id_kategori') == $kategori->id ? 'selected' : '' }} value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('id_kategori')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full rounded-lg bg-primary-500 py-2 font-semibold text-white transition duration-300 hover:bg-primary-600">Tambah</button>
            </form>
        </div>
    </div>
</x-dashboard.layout>
