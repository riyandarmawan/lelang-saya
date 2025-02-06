<x-dashboard.layout :$title>
    <div class="flex h-full items-center justify-center p-8">
        <div class="w-full max-w-md rounded-lg border border-primary-950 bg-white p-6 shadow-lg">
            <h3 class="mb-4 text-center font-semibold text-primary-500">Tambah Barang</h3>
            <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                @csrf
                <div x-data="{ preview: null }">
                    <label for="gambar" class="block font-medium text-gray-700">Upload Gambar</label>
                    <input type="file" id="gambar" name="gambar" value="{{ old('gambar') }}"
                        class="@error('gambar') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        @change="preview = URL.createObjectURL($event.target.files[0])" required>
                    <template x-if="preview">
                        <img :src="preview" alt="Preview" class="mt-4 h-48 w-full rounded-lg object-cover">
                    </template>
                    @error('gambar')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="nama_barang" class="block font-medium text-gray-700">Nama Barang</label>
                    <input type="text" id="nama_barang" name="nama_barang" value="{{ old('nama_barang') }}"
                        class="@error('nama_barang') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                    @error('nama_barang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="tanggal" class="block font-medium text-gray-700">Tanggal</label>
                    <input type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" type="date" id="tanggal" name="tanggal" value="{{ date('Y-m-d') }}" {{ old('gambar') }}"
                        class="@error('tanggal') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                    @error('tanggal')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="harga_awal" class="block font-medium text-gray-700">Harga Awal</label>
                    <input type="text" inputmode="numeric" id="harga_awal" name="harga_awal" value="{{ old('harga_awal') }}"
                        class="w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500 @error('harga_awal') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror">
                    @error('harga_awal')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="deskripsi_barang" class="block font-medium text-gray-700">Deskripsi</label>
                    <textarea id="deskripsi_barang" name="deskripsi_barang"
                        class="@error('deskripsi_barang') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        rows="3" required>{{ old('deskripsi_barang') }}</textarea>
                    @error('deskripsi_barang')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="kategori_id" class="block font-medium text-gray-700">Kategori</label>
                    <select id="kategori_id" name="kategori_id"
                        class="@error('kategori_id') border-red-500 text-red-500 placeholder:text-red-300 ring-red-500 @enderror w-full rounded-lg border px-4 py-2 focus:outline-none focus:ring-2 focus:ring-primary-500"
                        required>
                        @foreach ($kategoris as $kategori)
                            <option {{ old('kategori_id') == $kategori->id ? 'selected' : '' }} value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit"
                    class="w-full rounded-lg bg-primary-500 py-2 font-semibold text-white transition duration-300 hover:bg-primary-600">Tambah</button>
            </form>
        </div>
    </div>
</x-dashboard.layout>
