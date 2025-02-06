<?php

namespace Database\Seeders;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Masyarakat;
use App\Models\HistoryLelang;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class HistoryLelangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HistoryLelang::factory(20)->recycle(Lelang::all(), Barang::all(), Masyarakat::all())->create();
    }
}
