<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PemakaianSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pemakaian')->insert([

            [
                'pelanggan_id' => 1,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 100,
                'meter_akhir' => 150,
                'total_kwh' => 50,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 2,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 200,
                'meter_akhir' => 280,
                'total_kwh' => 80,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 3,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 300,
                'meter_akhir' => 390,
                'total_kwh' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 4,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 400,
                'meter_akhir' => 470,
                'total_kwh' => 70,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 5,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 500,
                'meter_akhir' => 620,
                'total_kwh' => 120,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 6,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 600,
                'meter_akhir' => 660,
                'total_kwh' => 60,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 7,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 700,
                'meter_akhir' => 800,
                'total_kwh' => 100,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 8,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 800,
                'meter_akhir' => 940,
                'total_kwh' => 140,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 9,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 900,
                'meter_akhir' => 1010,
                'total_kwh' => 110,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 10,
                'bulan' => 'Mei',
                'tahun' => 2026,
                'meter_awal' => 1000,
                'meter_akhir' => 1065,
                'total_kwh' => 65,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}