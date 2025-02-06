<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Barang>
 */
class BarangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'gambar' => '1.jpg',
            'nama_barang' => fake()->words('2', true),
            'tanggal' => fake()->date(),
            'harga_awal' => fake()->numberBetween(1000, 1000000),
            'deskripsi_barang' => fake()->text(100),
        ];
    }
}
 