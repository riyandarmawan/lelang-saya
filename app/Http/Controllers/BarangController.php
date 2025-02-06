<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Dashboard Barang | lelangsaya',
            'barangs' => Barang::paginate(10),
        ];

        return view('pages.dashboard.barang.index', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Create | Dashboard Barang | lelangsaya',
        ];

        return view('pages.dashboard.barang.create', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'gambar' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'nama_barang' => 'required|string|max:25',
            'tanggal' => 'required|date',
            'harga_awal' => 'required|numeric|min:0',
            'deskripsi_barang' => 'required|string|max:100',
        ], [
            'gambar.required' => 'Gambar wajib diunggah.',
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',

            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang tidak boleh lebih dari 25 karakter.',

            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',

            'harga_awal.required' => 'Harga awal wajib diisi.',
            'harga_awal.numeric' => 'Harga awal harus berupa angka.',
            'harga_awal.min' => 'Harga awal tidak boleh kurang dari 0.',

            'deskripsi_barang.required' => 'Deskripsi barang wajib diisi.',
            'deskripsi_barang.string' => 'Deskripsi barang harus berupa teks.',
            'deskripsi_barang.max' => 'Deskripsi barang tidak boleh lebih dari 100 karakter.',
        ]);

        $barang = new Barang();

        $namaGambar = time() . '.' . $request->gambar->extension();
        $request->gambar->move(public_path('images/barangs'), $namaGambar);

        $barang->gambar = $namaGambar;
        $barang->nama_barang = $request->nama_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->tanggal = $request->tanggal;
        $barang->harga_awal = $request->harga_awal;
        $barang->deskripsi_barang = $request->deskripsi_barang;

        $barang->save();

        return redirect('/dashboard/barang')->with('success', 'Anda berhasil menambah barang baru!');
    }

    public function update($id)
    {
        $data = [
            'title' => 'Update | Dashboard Barang | lelangsaya',
            'barang' => Barang::find($id),
        ];

        return view('pages.dashboard.barang.update', $data);
    }

    public function change(Request $request, $id)
    {
        $request->validate([
            'gambar' => 'image|mimes:jpeg,png,jpg|max:2048',
            'nama_barang' => 'required|string|max:25',
            'tanggal' => 'required|date',
            'harga_awal' => 'required|numeric|min:0',
            'deskripsi_barang' => 'required|string|max:100',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, atau jpg.',
            'gambar.max' => 'Ukuran gambar tidak boleh lebih dari 2MB.',

            'nama_barang.required' => 'Nama barang wajib diisi.',
            'nama_barang.string' => 'Nama barang harus berupa teks.',
            'nama_barang.max' => 'Nama barang tidak boleh lebih dari 25 karakter.',

            'tanggal.required' => 'Tanggal wajib diisi.',
            'tanggal.date' => 'Format tanggal tidak valid.',

            'harga_awal.required' => 'Harga awal wajib diisi.',
            'harga_awal.numeric' => 'Harga awal harus berupa angka.',
            'harga_awal.min' => 'Harga awal tidak boleh kurang dari 0.',

            'deskripsi_barang.required' => 'Deskripsi barang wajib diisi.',
            'deskripsi_barang.string' => 'Deskripsi barang harus berupa teks.',
            'deskripsi_barang.max' => 'Deskripsi barang tidak boleh lebih dari 100 karakter.',
        ]);

        $barang = Barang::find($id);

        if ($request->gambar == null) {
            $namaGambar = $barang->gambar;
        } else if ($barang->gambar != '1.jpg') {
            unlink(public_path("images/barangs/{$barang->gambar}"));
            $namaGambar = time() . '.' . $request->gambar->extension();
            $request->gambar->move(public_path('images/barangs'), $namaGambar);
        }

        $barang->gambar = $namaGambar;
        $barang->nama_barang = $request->nama_barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->tanggal = $request->tanggal;
        $barang->harga_awal = $request->harga_awal;
        $barang->deskripsi_barang = $request->deskripsi_barang;

        $barang->save();

        return redirect('/dashboard/barang')->with('success', 'Anda berhasil mengubah barang tersebut!');
    }

    public function delete($id)
    {
        $barang = Barang::find($id);

        if ($barang->gambar != '1.jpg') {
            unlink(public_path("images/barangs/{$barang->gambar}"));
        }

        $barang->delete();

        return redirect('/dashboard/barang')->with('success', 'Barang tersebut berhasil dihapus!');
    }
}
