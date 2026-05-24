<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TarifSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tarifs')->insert([

            [
                'daya' => '450 VA',
                'tarif_per_kwh' => 415,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '900 VA',
                'tarif_per_kwh' => 605,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '1300 VA',
                'tarif_per_kwh' => 1444,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '2200 VA',
                'tarif_per_kwh' => 1444,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '3500 VA',
                'tarif_per_kwh' => 1699,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '4400 VA',
                'tarif_per_kwh' => 1699,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '5500 VA',
                'tarif_per_kwh' => 1699,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '6600 VA',
                'tarif_per_kwh' => 1699,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '7700 VA',
                'tarif_per_kwh' => 1699,
                'created_at' => now(),
                'updated_at' => now()
            ],

            [
                'daya' => '10600 VA',
                'tarif_per_kwh' => 1699,
                'created_at' => now(),
                'updated_at' => now()
            ]

        ]);
    }
}