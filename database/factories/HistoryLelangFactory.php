<?php

namespace Database\Factories;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\Masyarakat;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HistoryLelang>
 */
class HistoryLelangFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_lelang' => Lelang::factory(),
            'id_barang' => Barang::factory(),
            'id_user' => Masyarakat::factory(),
            'penawaran_harga' => fake()->numberBetween(),
        ];
    }
}
