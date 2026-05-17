<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MeterListrikSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('meter_listrik')->insert([

            [
                'pelanggan_id' => 1,
                'nomor_meter' => 'ML1001',
                'daya' => '900 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 2,
                'nomor_meter' => 'ML1002',
                'daya' => '1300 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 3,
                'nomor_meter' => 'ML1003',
                'daya' => '2200 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 4,
                'nomor_meter' => 'ML1004',
                'daya' => '3500 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 5,
                'nomor_meter' => 'ML1005',
                'daya' => '450 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 6,
                'nomor_meter' => 'ML1006',
                'daya' => '900 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 7,
                'nomor_meter' => 'ML1007',
                'daya' => '1300 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 8,
                'nomor_meter' => 'ML1008',
                'daya' => '2200 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 9,
                'nomor_meter' => 'ML1009',
                'daya' => '3500 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pelanggan_id' => 10,
                'nomor_meter' => 'ML1010',
                'daya' => '5500 VA',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}