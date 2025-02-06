<x-home.layout :$title>
    <div class="container flex flex-col gap-8">
        @if (session('success'))
            <div class="block rounded bg-green-500 bg-opacity-50 px-4 py-2 font-medium shadow">
                {{ session('success') }}
            </div>
        @endif

        @foreach ($kategoris as $kategori)
            @if ($kategori->lelangs()->exists())
                <div class="flex flex-col gap-4">
                    <h4 class="font-medium">{{ $kategori->nama_kategori }}</h4>
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        @foreach ($kategori->lelangs as $lelang)
                            <div x-data="{ detail: false }"
                                class="relative w-56 min-w-56 overflow-hidden rounded-lg border border-primary-950 shadow">
                                <img src="/images/barangs/{{ $lelang->barang->gambar }}"
                                    alt="{{ $lelang->barang->nama_barang }}"
                                    class="aspect-[9/6] w-full object-cover object-center">
                                <div class="flex flex-col gap-1 px-2 py-2">
                                    <h3 class="line-clamp-1 font-baumans font-medium">{{ $lelang->barang->nama_barang }}
                                    </h3>
                                    <p class="line-clamp-3">{{ $lelang->barang->deskripsi_barang }}</p>
                                    <span class="text-orange-500">Rp
                                        {{ $lelang->harga_akhir_format }}</span>
                                    <span class="text-sm text-red-500">
                                        {{ $lelang->tanggal_tutup_lelang }}</span>
                                    <button @click="detail = !detail"
                                        class="mt-2 rounded bg-primary-500 px-4 py-2 font-medium text-white shadow hover:bg-primary-600">Tawar</button>

                                    <!-- Display status message -->
                                    @if (!auth('masyarakat')->user())
                                        <div
                                            class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-slate-950 bg-opacity-90 p-2 text-red-500">
                                            <span class="i-mdi-close-circle text-4xl"></span>
                                            <h4 class="text-center text-sm font-semibold">
                                                Anda harus masuk
                                                {{ auth('petugas')->user() ? 'sebagai masyarakat' : ' terlebih dahulu' }}!
                                            </h4>
                                        </div>
                                    @elseif($lelang->status_message)
                                        <div
                                            class="{{ $lelang->status_class }} absolute inset-0 flex flex-col items-center justify-center gap-2 bg-slate-950 bg-opacity-90 p-2">
                                            <span class="{{ $lelang->icon }} text-4xl"></span>
                                            <h4 class="text-center text-sm font-semibold">
                                                {{ $lelang->status_message }}
                                            </h4>
                                        </div>
                                    @endif
                                    <div x-cloak x-show="detail"
                                        class="fixed bottom-0 right-0 top-0 z-50 flex w-[28rem] flex-col justify-between bg-white px-4 py-16 shadow-md">
                                        <span @click="detail = false"
                                            class="i-mdi-close absolute right-4 top-4 cursor-pointer text-4xl"></span>
                                        <div class="flex max-h-[28rem] flex-col gap-4 overflow-y-auto">
                                            <details class="bg-primary-200">
                                                <summary
                                                    class="cursor-pointer rounded bg-primary-400 px-4 py-2 font-medium text-white shadow outline-none">
                                                    Deskripsi</summary>
                                                <div class="rounded bg-primary-200 px-4 py-2">
                                                    <h2 class="mb-2 font-semibold">{{ $lelang->barang->nama_barang }}
                                                    </h2>
                                                    <p>{{ $lelang->barang->deskripsi_barang }}</p>
                                                </div>
                                            </details>
                                            <details open class="bg-primary-200">
                                                <summary
                                                    class="cursor-pointer rounded bg-primary-400 px-4 py-2 font-medium text-white shadow outline-none">
                                                    Penawaran</summary>
                                                <div class="flex flex-col gap-2 rounded bg-primary-200 px-4 py-2">
                                                        @forelse ($lelang->historyLelangs as $historyLelang)
                                                            <div class="rounded bg-primary-300 p-4 shadow">
                                                            <h6 class="mb-1 font-semibold">
                                                                {{ $historyLelang->masyarakat->nama_lengkap }} <span
                                                                    class="text-slate-800">{{ '@' . $historyLelang->masyarakat->username }}</span>
                                                            </h6>
                                                            <p class="text-green-600">
                                                                {{ $historyLelang->penawaran_harga }}</p>
                                                        </div>
                                                        @empty
                                                      <p class="text-red-500 font-medium">Belum ada penawaran!</p>
                                                        @endforelse
                                                </div>
                                            </details>
                                        </div>
                                        <form action="/bid/{{ $lelang->id }}" method="post">
                                            @csrf
                                            <div class="mb-1 flex justify-between">
                                                Penawaran tertinggi

                                                <span class="text-red-500">Rp {{ $lelang->harga_akhir_format }}</span>
                                            </div>
                                            <div class="mb-4">
                                                <input type="number" id="penawaran_harga" name="penawaran_harga"
                                                    min="{{ $lelang->harga_akhir + 1 }}"
                                                    class="{{ $errors->has('penawaran_harga') ? 'border-red-500 focus:ring-red-500' : 'focus:ring-primary-500 border-primary-500' }} w-full rounded border px-4 py-2 shadow outline-none focus:ring"
                                                    placeholder="Berapa harga yang anda tawar untuk barang ini?">
                                                @error('penawaran_harga')
                                                    <p class="mt-1 text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button
                                                class="w-full rounded bg-primary-500 px-4 py-2 font-medium text-white shadow hover:bg-primary-600">Tawar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-home.layout>
