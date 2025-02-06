<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryLelangController extends Controller
{
    public function bid(Request $request, $id_lelang)
    {
        $lelang = Lelang::find($id_lelang);

        $request->validate([
            'penawaran_harga' => "required",
        ], [
            'penawaran_harga.required' => 'Penawaran harus diisi!',
        ]);

        $lelang->historyLelangs()->create([
            'id_lelang' => $lelang->id,
            'id_barang' => $lelang->barang->id,
            'id_user' => Auth::guard('masyarakat')->user()->id,
            'penawaran_harga' => $request->penawaran_harga,
        ]);

        $lelang->harga_akhir = $request->penawaran_harga;
        $lelang->id_user = Auth::guard('masyarakat')->user()->id;
        $lelang->save();

        return back()->with('success', "Anda berhasil menawar barang " . $lelang->barang->nama_barang . "!");
    }
}
