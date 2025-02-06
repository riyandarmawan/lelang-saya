<x-base-layout :$title>
    <div class="h-screen w-screen">
        <header class="fixed inset-x-0 top-0 z-50 bg-primary-500 py-6 text-white shadow-lg">
            <div class="flex items-center gap-4 px-4">
                <span class="i-mdi-hamburger-menu cursor-pointer text-4xl font-medium"></span>
                <h2 class="font-baumans font-bold">lelangsaya</h2>
            </div>
        </header>
        <div
            class="fixed left-0 top-16 bottom-0 flex w-fit flex-col justify-between bg-primary-500 px-4 py-4 pt-10 z-40 text-white">
            <nav class="flex flex-col gap-4">
                <a href="/dashboard/laporan"
                    class="flex items-center gap-4 rounded p-2 text-2xl font-semibold {{ Request::is('dashboard/laporan') || Request::is('dashboard/laporan/*') ? 'bg-white text-primary-500 hover:bg-opacity-90' : 'hover:bg-white hover:text-primary-500' }}">
                    <span class="i-mdi-printer text-4xl"></span>
                    Laporan
                </a>
                <a href="/dashboard/barang"
                    class="flex items-center gap-4 rounded p-2 text-2xl font-semibold {{ Request::is('dashboard/barang') || Request::is('dashboard/barang/*') ? 'bg-white text-primary-500 hover:bg-opacity-90' : 'hover:bg-white hover:text-primary-500' }}">
                    <span class="i-bi-boxes text-4xl"></span>
                    Barang
                </a>
                <a href="/dashboard/lelang"
                    class="flex items-center gap-4 rounded p-2 text-2xl font-semibold {{ Request::is('dashboard/lelang') || Request::is('dashboard/lelang/*') ? 'bg-white text-primary-500 hover:bg-opacity-90' : 'hover:bg-white hover:text-primary-500' }}">
                    <span class="i-hugeicons-auction text-4xl"></span>
                    Lelang
                </a>
                <a href="/dashboard/penawaran"
                    class="flex items-center gap-4 rounded p-2 text-2xl font-semibold {{ Request::is('dashboard/penawaran') || Request::is('dashboard/penawaran/*') ? 'bg-white text-primary-500 hover:bg-opacity-90' : 'hover:bg-white hover:text-primary-500' }}">
                    <span class="i-mdi-hand-front-left text-4xl"></span>
                    Penawaran
                </a>
            </nav>
            <form action="/auth/logout" method="post" class="w-full">
                @csrf
                <button onclick="confirm('Apakah anda yakin ingin keluar?')" type="submit"
                    class="flex items-center gap-4 rounded p-2 text-2xl font-semibold hover:bg-white hover:text-primary-500 w-full">
                    <span class="i-mdi-logout text-4xl"></span>
                    Keluar
                </button>
            </form>
        </div>
        <div class="inset-0 top-20 left-56 absolute overflow-x-hidden"><div class="relative">{{ $slot }}</div></div>
    </div>
</x-base-layout>
