<?php

namespace App\Models;

use App\Models\Lelang;
use App\Models\HistoryLelang;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Barang extends Model
{
    /** @use HasFactory<\Database\Factories\BarangFactory> */
    use HasFactory;

    protected $guarded = [];

    public function lelang() {
        return $this->hasOne(Lelang::class, 'id', 'id_barang');
    }

    public function historyLelangs()
    {
        return $this->hasMany(HistoryLelang::class, 'id_barang', 'id');
    }
}
