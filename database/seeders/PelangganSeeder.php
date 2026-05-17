<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelanggan;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pelanggan::create([
            'nama' => 'Raihan',
            'alamat' => 'Pekanbaru',
            'no_meter' => '1001',
            'no_hp' => '0811111111'
        ]);

        Pelanggan::create([
            'nama' => 'Budi',
            'alamat' => 'Jakarta',
            'no_meter' => '1002',
            'no_hp' => '0822222222'
        ]);

        Pelanggan::create([
            'nama' => 'Andi',
            'alamat' => 'Bandung',
            'no_meter' => '1003',
            'no_hp' => '0833333333'
        ]);

        Pelanggan::create([
            'nama' => 'Siti',
            'alamat' => 'Medan',
            'no_meter' => '1004',
            'no_hp' => '0844444444'
        ]);

        Pelanggan::create([
            'nama' => 'Dewi',
            'alamat' => 'Padang',
            'no_meter' => '1005',
            'no_hp' => '0855555555'
        ]);

        Pelanggan::create([
            'nama' => 'Ahmad',
            'alamat' => 'Aceh',
            'no_meter' => '1006',
            'no_hp' => '0866666666'
        ]);

        Pelanggan::create([
            'nama' => 'Rina',
            'alamat' => 'Batam',
            'no_meter' => '1007',
            'no_hp' => '0877777777'
        ]);

        Pelanggan::create([
            'nama' => 'Fajar',
            'alamat' => 'Surabaya',
            'no_meter' => '1008',
            'no_hp' => '0888888888'
        ]);

        Pelanggan::create([
            'nama' => 'Nina',
            'alamat' => 'Yogyakarta',
            'no_meter' => '1009',
            'no_hp' => '0899999999'
        ]);

        Pelanggan::create([
            'nama' => 'Doni',
            'alamat' => 'Semarang',
            'no_meter' => '1010',
            'no_hp' => '0810000000'
        ]);
    }
}