<x-base-layout :$title>
    <div class="container flex h-screen items-center justify-between gap-20 py-8">
        <div class="flex flex-col justify-center gap-4">
            <h2 class="mb-4 font-medium">Masuk Ke Akun Anda</h2>
            <form action="" method="POST" class="flex flex-col items-center gap-4">
                @csrf
                <div class="w-full">
                    <input type="text" name="username" id="username" placeholder="Username" value="{{ old('username') }}" required
                        class="w-full rounded border border-primary-950 px-4 py-2 shadow outline-none focus:ring focus:ring-primary-950 {{ $errors->has('username') ? '!border-red-500 focus:!ring-red-500 text-red-500 placeholder:text-red-300' : '' }}">
                        @error('username')
                        <p class="ml-2 mt-2 text-red-500">{{ $message }}</p>
                        @enderror
                </div>
                <div x-data="{ show: false }" class="relative w-full">
                    <input :type="show ? 'text' : 'password'" name="password" id="password" placeholder="Kata Sandi" required
                        
                        class="w-full rounded border border-primary-950 px-4 py-2 shadow outline-none focus:ring focus:ring-primary-950 {{ $errors->has('password') ? '!border-red-500 focus:!ring-red-500 text-red-500 placeholder:text-red-300' : '' }}">
                        @error('password')
                        <p class="ml-2 mt-2 text-red-500">{{ $message }}</p>
                        @enderror
                    <span :class="show ? 'i-mdi-eye-closed' : 'i-mdi-eye'" @click="show = !show"
                        class="absolute right-4 top-3 cursor-pointer text-xl {{ $errors->has('password') ? 'text-red-500' : '' }}"></span>
                </div>
                <button
                    class="w-full rounded bg-primary-500 px-4 py-2 font-semibold text-white shadow hover:bg-opacity-80">Masuk</button>
            </form>
            <span class="text-center">atau</span>
            <p class="text-center">Belum punya akun? <a href="/auth/register"
                    class="font-semibold text-primary-600 hover:opacity-80">Daftar sekarang!</a></p>
        </div>
        {{-- <img src="/images/login.jpg" alt="" class="h-full max-h-[700px] max-w-3xl rounded-xl object-cover"> --}}
    </div>
</x-base-layout>
