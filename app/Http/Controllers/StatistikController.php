<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\Pemakaian;
use App\Models\Tagihan;
use App\Models\Pembayaran;

class StatistikController extends Controller
{
    public function totalPelanggan()
    {
        return response()->json([
            'total_pelanggan' => Pelanggan::count()
        ]);
    }

    public function totalTagihan()
    {
        return response()->json([
            'total_tagihan' =>
                Tagihan::sum('jumlah_tagihan')
        ]);
    }

    public function totalPembayaran()
    {
        return response()->json([
            'total_pembayaran' =>
                Pembayaran::sum('total_bayar')
        ]);
    }

    public function totalPemakaian()
    {
        return response()->json([
            'total_pemakaian_kwh' =>
                Pemakaian::sum('total_kwh')
        ]);
    }
}