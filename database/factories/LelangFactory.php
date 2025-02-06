<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Petugas;
use App\Models\Kategori;
use App\Models\Masyarakat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lelang>
 */
class LelangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_barang' => Barang::factory(),
            'tanggal_lelang' => fake()->dateTimeBetween('-30days', '30days')->format('Y-m-d'),
            'tanggal_tutup_lelang' => fake()->dateTimeBetween('-30days', 'now')->format('Y-m-d'),
            'harga_akhir' => '0',
            'id_user' => Masyarakat::factory(),
            'id_petugas' => Petugas::factory(),
            'id_kategori' => Kategori::factory(),
            // 'status' => 'ditutup',
        ];
    }
}
