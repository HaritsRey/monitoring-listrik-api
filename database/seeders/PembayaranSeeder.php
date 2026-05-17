<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pembayaran')->insert([

            [
                'tagihan_id' => 1,
                'tanggal_bayar' => '2026-05-01',
                'total_bayar' => 75000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 2,
                'tanggal_bayar' => '2026-05-02',
                'total_bayar' => 120000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 3,
                'tanggal_bayar' => '2026-05-03',
                'total_bayar' => 135000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 4,
                'tanggal_bayar' => '2026-05-04',
                'total_bayar' => 105000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 5,
                'tanggal_bayar' => '2026-05-05',
                'total_bayar' => 180000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 6,
                'tanggal_bayar' => '2026-05-06',
                'total_bayar' => 90000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 7,
                'tanggal_bayar' => '2026-05-07',
                'total_bayar' => 150000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 8,
                'tanggal_bayar' => '2026-05-08',
                'total_bayar' => 210000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 9,
                'tanggal_bayar' => '2026-05-09',
                'total_bayar' => 165000,
                'created_at' => now(),
                'updated_at' => now(),
            ],

            [
                'tagihan_id' => 10,
                'tanggal_bayar' => '2026-05-10',
                'total_bayar' => 97500,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);
    }
}