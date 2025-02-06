<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\PetugasSeeder;
use Database\Seeders\HistoryLelangSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin Koran',
            'username' => 'admin',
            'email' => 'admin@example.com',
        ]);

        $this->call([
            LevelSeeder::class,
            PetugasSeeder::class,
            MasyarakatSeeder::class,
            BarangSeeder::class,
            KategoriSeeder::class,
            LelangSeeder::class,
            // HistoryLelangSeeder::class,
        ]);
    }
}
