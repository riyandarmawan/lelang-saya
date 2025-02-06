<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        if (Auth::guard('masyarakat')->attempt($credentials) || Auth::guard('petugas')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'username' => 'Username mungkin salah',
            'password' => 'Kata sandi mungkin salah',
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
            'username' => 'required',
            'password' => 'required',
        ], [
            // username
            'username.required' => 'Username wajib diisi!',

            // password
            'password.required' => 'Kata sandi wajib diisi!',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'username' => 'Username mungkin salah',
            'password' => 'Kata sandi mungkin salah',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::guard('masyarakat')->logout();
        Auth::guard('petugas')->logout();

        $request->session()->regenerate();

        return redirect()->intended('/');
    }
}
