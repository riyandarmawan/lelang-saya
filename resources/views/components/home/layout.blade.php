<x-base-layout :$title>
    <header class="fixed inset-x-0 top-0 z-50 bg-primary-500 py-6 text-white shadow-lg">
        <div class="container flex items-center justify-between">
            <h2 class="font-baumans font-bold">lelangsaya</h2>

            <nav class="flex items-center gap-6 text-lg font-medium">
                <a href="/">Beranda</a>
                @if (auth('masyarakat')->user() || auth('petugas')->user())
                    @if (auth('petugas')->user())
                        <a href="/dashboard/barang"
                            class="rounded border border-white px-4 py-2 shadow hover:bg-white hover:text-primary-500">Dashboard</a>
                    @endif
                    <form action="/auth/logout" method="post" class="w-full">
                        @csrf
                        <button onclick="confirm('Apakah anda yakin ingin keluar?')" type="submit"
                            class="rounded border border-white bg-white px-4 py-2 text-primary-500 shadow hover:bg-transparent hover:text-white">
                            Keluar
                        </button>
                    </form>
                @else
                    <a href="/auth/login"
                        class="rounded border border-white px-4 py-2 shadow hover:bg-white hover:text-primary-500">Masuk</a>
                    <a href="/auth/register"
                        class="rounded border border-white bg-white px-4 py-2 text-primary-500 shadow hover:bg-transparent hover:text-white">Daftar</a>
                @endif
            </nav>
        </div>
    </header>

    <div class="pt-32">
        {{ $slot }}}
    </div>

    <footer class="container py-8 text-center"><span class="font-baumans font-medium">lelangsaya</span>
        &copy;{{ date('Y') }} All Right Reserved.</footer>
</x-base-layout>
