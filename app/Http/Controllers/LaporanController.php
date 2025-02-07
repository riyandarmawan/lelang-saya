<?php

namespace App\Http\Controllers;

use App\Models\Lelang;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Laporan | lelangsaya',
            'lelangs' => Lelang::with('barang', 'kategori', 'masyarakat')
                ->where('tanggal_tutup_lelang', '<', now()) // Only closed auctions
                ->get(),
        ];

        return view('pages.dashboard.laporan.index', $data);
    }

    public function exportPDF()
    {
        $lelangs = Lelang::with('barang', 'kategori', 'masyarakat')
            ->where('tanggal_tutup_lelang', '<', now()) // Only closed auctions
            ->get();

        $pdf = Pdf::loadView('exports.laporan', compact('lelangs'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-lelang.pdf');
    }
}
