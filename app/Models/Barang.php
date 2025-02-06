<?php

namespace App\Models;

use App\Models\Lelang;
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
}
