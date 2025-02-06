<?php

namespace App\Models;

use App\Models\Barang;
use App\Models\Masyarakat;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Lelang;

class HistoryLelang extends Model
{
    /** @use HasFactory<\Database\Factories\HistoryLelangFactory> */
    use HasFactory;

    protected $guarded = [];

    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'id_barang', 'id');
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang', 'id');
    }

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'id_user', 'id');
    }
}
