<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Illuminate\Http\Request;

class LelangController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Dashboard Lelang | lelangsaya',
            'lelangs' => Lelang::with(['masyarakat', 'petugas', 'kategori'])->paginate(10),
        ];

        return view('pages.dashboard.lelang.index', $data);
    }

    public function delete($id) {
        $lelang = Lelang::find($id);

        $lelang->delete();

        return redirect('/dashboard/lelang')->with('success', 'Lelang tersebut berhasil dihapus!');
    }
}
