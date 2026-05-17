<?php

namespace App\Http\Controllers;

use App\Models\Pembayaran;
use App\Models\Tagihan;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function index()
    {
        return response()->json(
            Pembayaran::with(
                'tagihan.pemakaian.pelanggan'
            )->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'tagihan_id' => 'required'
        ]);

        $tagihan = Tagihan::findOrFail(
            $request->tagihan_id
        );

        $pembayaran = Pembayaran::create([
            'tagihan_id' => $tagihan->id,
            'tanggal_bayar' => now(),
            'total_bayar' => $tagihan->jumlah_tagihan
        ]);

        $tagihan->update([
            'status' => 'LUNAS'
        ]);

        return response()->json($pembayaran);
    }

    public function show(string $id)
    {
        return response()->json(
            Pembayaran::with(
                'tagihan.pemakaian.pelanggan'
            )->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $pembayaran = Pembayaran::findOrFail($id);

        $pembayaran->update($request->all());

        return response()->json($pembayaran);
    }

    public function destroy(string $id)
    {
        Pembayaran::destroy($id);

        return response()->json([
            'message' => 'Pembayaran berhasil dihapus'
        ]);
    }
}