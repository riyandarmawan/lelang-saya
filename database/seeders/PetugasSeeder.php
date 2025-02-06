<?php

namespace Database\Seeders;

use App\Models\Level;
use App\Models\Petugas;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PetugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Petugas::factory()->recycle(Level::all())->create(['username' => 'petugas']);

        Petugas::factory(10)->recycle(Level::all())->create();
    }
}
