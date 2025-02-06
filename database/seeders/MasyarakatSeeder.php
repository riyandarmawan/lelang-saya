<?php

namespace Database\Seeders;

use App\Models\Masyarakat;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MasyarakatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Masyarakat::factory()->create([
            'username' => 'masyarakat',
        ]);
        
        Masyarakat::factory(10)->create();
    }
}
