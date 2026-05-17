<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            PelangganSeeder::class,
            MeterListrikSeeder::class,
            PemakaianSeeder::class,
            TagihanSeeder::class,
            PembayaranSeeder::class,
        ]);
    }
}