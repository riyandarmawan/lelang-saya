<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class LelangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lelang::factory()->recycle([Barang::all(), Petugas::all(), Masyarakat::all(), Kategori::all()])->create(['status' => 'dibuka']);

        Lelang::factory(10)->recycle([Barang::all(), Petugas::all(), Masyarakat::all(), Kategori::all()])->create();
    }
}
