<x-home.layout :$title>
    <div class="container flex flex-col gap-8">
        @foreach ($kategoris as $kategori)
            @if ($kategori->lelangs()->exists())
                <div class="flex flex-col gap-4">
                    <h4 class="font-medium">{{ $kategori->nama_kategori }}</h4>
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        @foreach ($kategori->lelangs as $lelang)
                            <div class="relative min-w-56 w-56 overflow-hidden rounded-lg border border-primary-950 shadow">
                                <img src="/images/barangs/{{ $lelang->barang->gambar }}"
                                     alt="{{ $lelang->barang->nama_barang }}"
                                     class="aspect-[9/6] w-full object-cover object-center">
                                <div class="flex flex-col gap-1 px-2 py-2">
                                    <h3 class="line-clamp-1 font-baumans font-medium">{{ $lelang->barang->nama_barang }}</h3>
                                    <p class="line-clamp-3">{{ $lelang->barang->deskripsi_barang }}</p>
                                    <span class="text-orange-500">Rp
                                        {{ $lelang->barang->harga_awal }}</span>
                                    <span class="text-red-500 text-sm">
                                        {{ $lelang->tanggal_tutup_lelang }}</span>
                                    <button
                                        class="mt-2 rounded bg-primary-500 px-4 py-2 font-medium text-white shadow hover:bg-primary-600">Tawar</button>

                                    <!-- Display status message -->
                                    @if ($lelang->status == 'ditutup')
                                        <div class="absolute inset-0 flex flex-col items-center justify-center gap-2 bg-slate-950 bg-opacity-90 {{ $lelang->status_class }} p-2">
                                            <span class="{{ $lelang->icon }} text-4xl"></span>
                                            <h4 class="text-center text-sm font-semibold">
                                                {{ $lelang->status_message }}
                                            </h4>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</x-home.layout>
