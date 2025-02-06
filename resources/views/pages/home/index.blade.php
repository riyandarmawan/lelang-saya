<x-home.layout :$title>
    <div class="container flex flex-col gap-8">
        @foreach ($kategoris as $kategori)
            @if ($kategori->lelangs()->exists())
                <div class="flex flex-col gap-4">
                    <h4 class="font-medium">{{ $kategori->nama_kategori }}</h4>
                    <div class="flex gap-4 overflow-x-auto pb-2">
                        @foreach ($kategori->lelangs as $lelang)
                            <div x-data="{detail: false}"
                                class="relative w-56 min-w-56 overflow-hidden rounded-lg border border-primary-950 shadow">
                                <img src="/images/barangs/{{ $lelang->barang->gambar }}"
                                    alt="{{ $lelang->barang->nama_barang }}"
                                    class="aspect-[9/6] w-full object-cover object-center">
                                <div class="flex flex-col gap-1 px-2 py-2">
                                    <h3 class="line-clamp-1 font-baumans font-medium">{{ $lelang->barang->nama_barang }}
                                    </h3>
                                    <p class="line-clamp-3">{{ $lelang->barang->deskripsi_barang }}</p>
                                    <span class="text-orange-500">Rp
                                        {{ $lelang->barang->harga_awal }}</span>
                                    <span class="text-sm text-red-500">
                                        {{ $lelang->tanggal_tutup_lelang }}</span>
                                    <button @click="detail = !detail"
                                        class="mt-2 rounded bg-primary-500 px-4 py-2 font-medium text-white shadow hover:bg-primary-600">Tawar</button>

                                    <!-- Display status message -->
                                    @if ($lelang->status == 'ditutup')
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
                                        <span @click="detail = false" class="i-mdi-close absolute right-4 top-4 cursor-pointer text-4xl"></span>
                                        <div class="flex flex-col gap-4">
                                            <details class="bg-blue-200">
                                                <summary
                                                    class="rounded bg-blue-400 px-4 py-2 font-medium text-white shadow outline-none">
                                                    Deskripsi</summary>
                                                <div class="rounded bg-blue-200 px-4 py-2">
                                                    <h2 class="mb-2 font-semibold">{{ $lelang->barang->nama_barang }}</h2>
                                                    <p>{{$lelang->barang->deskripsi_barang}}</p>
                                                </div>
                                            </details>
                                            <details class="bg-blue-200">
                                                <summary
                                                    class="rounded bg-blue-400 px-4 py-2 font-medium text-white shadow outline-none">
                                                    Penawaran</summary>
                                                <div class="flex flex-col gap-2 rounded bg-blue-200 px-4 py-2">
                                                    @foreach ($lelang->historyLelangs as $historyLelang)
                                                        <div class="bg-blue-300 rounded shadow p-4">
                                                        <h6 class="mb-1 font-semibold">{{ $historyLelang->masyarakat->nama_lengkap }}</h6>
                                                        <p>{{ $historyLelang->penawaran_harga }}</p>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </details>
                                        </div>
                                        <form action="/bid/">
                                            <input type="text" id="penawaran_harga" name="penawaran_harga" class="w-full py-2 px-4 mb-4 border border-primary-500 focus:ring focus:ring-primary-500 shadow rounded outline-none" placeholder="Harga tawar">
                                            <button class="w-full bg-blue-500 hover:bg-blue-600 py-2 px-4 text-white rounded shadow font-medium">Tawar</button>
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
