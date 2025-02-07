<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Fetch categories with related auctions, items, and winner data
        $kategoris = Kategori::with([
            'lelangs' => function ($query) {
                $query->with(['barang', 'masyarakat', 'historyLelangs' => fn($query) => $query->orderBy('penawaran_harga')->with('masyarakat')]); // Load barang and masyarakat (user) relations
            }
        ])->get();

        // Process each auction (lelang)
        foreach ($kategoris as $kategori) {
            foreach ($kategori->lelangs as $lelang) {
                $lelang->tanggal_lelang = Carbon::parse($lelang->tanggal_lelang);
                $lelang->harga_akhir_format = number_format($lelang->harga_akhir, 0, ',', '.');
                $lelang->tanggal_tutup_lelang = Carbon::parse($lelang->tanggal_tutup_lelang);

                if (now()->lessThan($lelang->tanggal_lelang)) {
                    $lelang->status_message = 'Dibuka ' . $lelang->tanggal_lelang->diffForHumans();
                    $lelang->status_class = 'text-yellow-500';
                    $lelang->icon = 'i-mdi-lock';
                } else if (now()->greaterThan($lelang->tanggal_tutup_lelang) && $lelang->masyarakat) {
                    $lelang->status_message = $lelang->masyarakat->nama_lengkap . ' (@' . $lelang->masyarakat->username . ')' . ' memenangi lelang dengan harga akhir mencapai Rp ' . $lelang->harga_akhir_format;
                    $lelang->status_class = 'text-green-500';
                    $lelang->icon = 'i-hugeicons-auction';
                } else if (now()->greaterThan($lelang->tanggal_tutup_lelang)) {
                    $lelang->status_message = 'Lelang berakhir tanpa pemenang!';
                    $lelang->status_class = 'text-red-500';
                    $lelang->icon = 'i-mdi-close-circle';
                }

                $lelang->tanggal_tutup_lelang = 'Ditutup ' . $lelang->tanggal_tutup_lelang->diffForHumans();

                foreach ($lelang->historyLelangs as $historyLelang) {
                    $historyLelang->penawaran_harga = 'Rp ' . number_format($historyLelang->penawaran_harga, 0, ',', '.');
                }
            }
        }

        // Passing processed data to the view
        $data = [
            'title' => 'Beranda | lelangsaya',
            'kategoris' => $kategoris,
        ];

        return view('pages.home.index', $data);
    }

    public function myBid()
    {
        $userId = optional(Auth::guard('masyarakat')->user())->id;

        // Fetch categories with related auctions, items, and winner data
        $kategoris = Kategori::with([
            'lelangs' => function ($query) {
                $query->with(['barang', 'masyarakat', 'historyLelangs' => fn($query) => $query->orderBy('penawaran_harga')->with('masyarakat')]);
            }
        ])->get();

        // Filter categories to only include those with user's lelangs
        $kategoris = $kategoris->map(function ($kategori) use ($userId) {
            // Filter lelangs within the category
            $kategori->lelangs = $kategori->lelangs->map(function ($lelang) use ($userId) {
                // Filter history lelangs berdasarkan userId
                $lelang->historyLelangs = $lelang->historyLelangs->filter(fn($historyLelang) => $historyLelang->id_user == $userId);

                // Hanya kembalikan lelang jika ada historyLelangs yang cocok
                return $lelang->historyLelangs->isNotEmpty() ? $lelang : null;
            })->filter(); // Hapus lelang yang null

            // Return kategori hanya jika masih memiliki lelangs
            return $kategori->lelangs->isNotEmpty() ? $kategori : null;
        })->filter(); // Hapus kategori yang null


        // Process each auction (lelang)
        foreach ($kategoris as $kategori) {
            foreach ($kategori->lelangs as $lelang) {
                $lelang->tanggal_lelang = Carbon::parse($lelang->tanggal_lelang);
                $lelang->harga_akhir_format = number_format($lelang->harga_akhir, 0, ',', '.');
                $lelang->tanggal_tutup_lelang = Carbon::parse($lelang->tanggal_tutup_lelang);

                if (now()->greaterThan($lelang->tanggal_tutup_lelang) && $lelang->masyarakat) {
                    $lelang->status_message = $lelang->masyarakat->nama_lengkap . ' (@' . $lelang->masyarakat->username . ')' . ' memenangi lelang dengan harga akhir mencapai Rp ' . $lelang->harga_akhir_format;
                    $lelang->status_class = 'text-green-500';
                    $lelang->icon = 'i-hugeicons-auction';
                }

                $lelang->tanggal_tutup_lelang = 'Ditutup ' . $lelang->tanggal_tutup_lelang->diffForHumans();

                foreach ($lelang->historyLelangs as $historyLelang) {
                    $historyLelang->penawaran_harga = 'Rp ' . number_format($historyLelang->penawaran_harga, 0, ',', '.');
                }
            }
        }

        $data = [
            'title' => 'Penawaran saya | lelangsaya',
            'kategoris' => $kategoris,
        ];

        return view('pages.home.index', $data);
    }
}
