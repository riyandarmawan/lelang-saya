<?php

namespace App\Http\Controllers;

use App\Models\Petugas;
use App\Models\Masyarakat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        $data = [
            'title' => 'Login | lelangsaya'
        ];

        return view('pages.auth.login', $data);
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ], [
            // username
            'username.required' => 'Username wajib diisi!',

            // password
            'password.required' => 'Kata sandi wajib diisi!',
        ]);

        $masyarakat = Masyarakat::where('username', $request->username)->exists();
        $petugas = Petugas::where('username', $request->username)->exists();

        if (!$masyarakat && !$petugas) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan',
            ]);
        }

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        if (Auth::guard('petugas')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'password' => 'Kata sandi salah',
        ])->onlyInput('username');
    }

    public function register()
    {
        $data = [
            'title' => 'Register | lelangsaya'
        ];

        return view('pages.auth.register', $data);
    }

    public function postRegister(Request $request)
    {
        $credentials = $request->validate([
            'nama_lengkap' => 'required|string|max:25',
            'username' => 'required|string|max:25',
            'password' => 'required|string',
            'telp' => 'required|string|max:13|regex:/^[0-9]+$/',
        ], [
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'telp.required' => 'Nomor telepon wajib diisi.',
            'telp.regex' => 'Nomor telepon hanya boleh berisi angka.',
        ]);

        $masyarakat = Masyarakat::where('username', $request->username)->exists();
        $petugas = Petugas::where('username', $request->username)->exists();

        if ($masyarakat || $petugas) {
            return back()->withErrors([
                'username' => 'Username telah digunakan! Cari opsi lain!',
            ])->onlyInput('nama_lengkap', 'telp');
        }

        $masyarakat = new Masyarakat();

        $masyarakat->nama_lengkap = $request->nama_lengkap;
        $masyarakat->telp = $request->telp;
        $masyarakat->username = $request->username;
        $masyarakat->password = Hash::Make($request->password);

        $masyarakat->save();

        if (Auth::guard('masyarakat')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        Auth::guard('petugas')->logout();

        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
