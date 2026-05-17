<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagihanSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tagihan')->insert([

            [
                'pemakaian_id' => 1,
                'jumlah_tagihan' => 75000,
                'status' => 'BELUM_LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 2,
                'jumlah_tagihan' => 120000,
                'status' => 'LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 3,
                'jumlah_tagihan' => 135000,
                'status' => 'BELUM_LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 4,
                'jumlah_tagihan' => 105000,
                'status' => 'LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 5,
                'jumlah_tagihan' => 180000,
                'status' => 'BELUM_LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 6,
                'jumlah_tagihan' => 90000,
                'status' => 'LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 7,
                'jumlah_tagihan' => 150000,
                'status' => 'BELUM_LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 8,
                'jumlah_tagihan' => 210000,
                'status' => 'LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 9,
                'jumlah_tagihan' => 165000,
                'status' => 'BELUM_LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'pemakaian_id' => 10,
                'jumlah_tagihan' => 97500,
                'status' => 'LUNAS',
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}