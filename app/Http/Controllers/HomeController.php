<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kategori;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch categories with related auctions, items, and winner data
        $kategoris = Kategori::with([
            'lelangs' => function ($query) {
                $query->with(['barang', 'masyarakat']); // Load barang and masyarakat (user) relations
            }
        ])->get();

        // Process each auction (lelang)
        foreach ($kategoris as $kategori) {
            foreach ($kategori->lelangs as $lelang) {
                $tanggalLelang = Carbon::parse($lelang->tanggal_lelang);
                $lelang->harga_akhir = number_format($lelang->harga_akhir, 0, ',', '.');
                $lelang->barang->harga_awal = number_format($lelang->barang->harga_awal, 0, ',', '.');

                if ($lelang->status == 'ditutup' && now()->lessThan($lelang->tanggal_lelang)) {
                    $lelang->status_message = 'Dibuka ' . Carbon::parse($lelang->tanggal_lelang)->diffForHumans();
                    $lelang->status_class = 'text-yellow-500';
                    $lelang->icon = 'i-mdi-lock';
                } else if ($lelang->status == 'ditutup' && $lelang->masyarakat) {
                    $lelang->status_message = $lelang->masyarakat->nama_lengkap . ' memenangi lelang dengan harga akhir mencapai Rp ' . $lelang->harga_akhir;
                    $lelang->status_class = 'text-green-500';
                    $lelang->icon = 'i-hugeicons-auction';
                }

                $lelang->tanggal_tutup_lelang = 'Ditutup ' . Carbon::parse($lelang->tanggal_tutup_lelang)->diffForHumans();
            }
        }

        // Passing processed data to the view
        $data = [
            'title' => 'Beranda | lelangsaya',
            'kategoris' => $kategoris,
        ];

        return view('pages.home.index', $data);
    }
}
