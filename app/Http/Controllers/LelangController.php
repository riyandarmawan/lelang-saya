<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LelangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Lelang | lelangsaya',
            'lelangs' => Lelang::with(['masyarakat', 'petugas', 'kategori'])->paginate(10),
        ];

        return view('pages.dashboard.lelang.index', $data);
    }

    public function create()
    {
        $data = ['title' => 'Tambah Lelang | lelangsaya', 'barangs' => Barang::all(), 'kategoris' => Kategori::all()];

        return view('pages.dashboard.lelang.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|integer|exists:barangs,id',
            'tanggal_lelang' => 'required|date|after_or_equal:today',
            'tanggal_tutup_lelang' => 'required|date|after:tanggal_lelang',
            'id_kategori' => 'required|integer|exists:kategoris,id',
        ], [
            'id_barang.required' => 'Barang harus dipilih.',
            'tanggal_lelang.required' => 'Tanggal lelang harus diisi.',
            'tanggal_tutup_lelang.after' => 'Tanggal tutup harus setelah tanggal lelang.',
            'id_kategori.required' => 'Kategori harus dipilih.',
        ]);

        $lelang = new Lelang();

        $lelang->id_barang = $request->id_barang;
        $lelang->tanggal_lelang = $request->tanggal_lelang;
        $lelang->tanggal_tutup_lelang = $request->tanggal_tutup_lelang;
        $lelang->id_kategori = $request->id_kategori;
        $lelang->harga_akhir = 0;
        $lelang->id_user = null;
        $lelang->id_petugas = Auth::guard('petugas')->user()->id;

        $lelang->save();

        return redirect('/dashboard/lelang')->with('success', 'Lelang berhasil dibuat!');
    }

    public function update($id_lelang)
    {
        $data = ['title' => 'Ubah Lelang | lelangsaya', 'lelang' => Lelang::find($id_lelang), 'barangs' => Barang::all(), 'kategoris' => Kategori::all()];

        return view('pages.dashboard.lelang.update', $data);
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'id_barang' => 'required|integer|exists:barangs,id',
            'tanggal_lelang' => 'required|date',
            'tanggal_tutup_lelang' => 'required|date|after:tanggal_lelang',
            'id_kategori' => 'required|integer|exists:kategoris,id',
        ], [
            'id_barang.required' => 'Barang harus dipilih.',
            'tanggal_lelang.required' => 'Tanggal lelang harus diisi.',
            'tanggal_tutup_lelang.after' => 'Tanggal tutup harus setelah tanggal lelang.',
            'id_kategori.required' => 'Kategori harus dipilih.',
        ]);

        $lelang = Lelang::find($id);

        $lelang->id_barang = $request->id_barang;
        $lelang->tanggal_lelang = $request->tanggal_lelang;
        $lelang->tanggal_tutup_lelang = $request->tanggal_tutup_lelang;
        $lelang->id_kategori = $request->id_kategori;
        $lelang->id_petugas = Auth::guard('petugas')->user()->id;

        $lelang->save();

        return redirect('/dashboard/lelang')->with('success', 'Lelang berhasil diubah!');
    }

    public function delete($id)
    {
        $lelang = Lelang::find($id);

        $lelang->delete();

        return redirect('/dashboard/lelang')->with('success', 'Lelang tersebut berhasil dihapus!');
    }
}
