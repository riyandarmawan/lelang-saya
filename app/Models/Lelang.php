<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Masyarakat;
use App\Models\HistoryLelang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lelang extends Model
{
    /** @use HasFactory<\Database\Factories\LelangFactory> */
    use HasFactory;

    protected $guarded = [];

    protected static function booted()
    {
        static::creating(function ($lelang) {
            // Automatically set harga_akhir from harga_awal in Barang when Lelang is created
            $barang = Barang::find($lelang->id_barang);
            if ($barang) {
                $lelang->harga_akhir = $barang->harga_awal;
            }
        });
    }

    public function historyLelangs()
    {
        return $this->hasMany(HistoryLelang::class, 'id_lelang', 'id');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'id_user', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'id_petugas', 'id');
    }
}
