<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    /**
     * Tampilkan semua tagihan
     */
    public function index()
    {
        $tagihan = Tagihan::with('pemakaian')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data tagihan berhasil diambil',
            'data' => $tagihan
        ]);
    }

    /**
     * Simpan tagihan baru
     */
    public function store(Request $request)
    {
        try {

            // Validasi input
            $request->validate([
                'pemakaian_id' => 'required|exists:pemakaian,id'
            ]);

            // Cek apakah tagihan sudah ada
            $cekTagihan = Tagihan::where('pemakaian_id', $request->pemakaian_id)->first();

            if ($cekTagihan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tagihan untuk pemakaian ini sudah dibuat'
                ], 400);
            }

            // Ambil data pemakaian
            $pemakaian = Pemakaian::find($request->pemakaian_id);

            // Validasi meter
            if ($pemakaian->meter_akhir < $pemakaian->meter_awal) {
                return response()->json([
                    'success' => false,
                    'message' => 'Meter akhir tidak boleh lebih kecil dari meter awal'
                ], 400);
            }

            // Hitung jumlah meter
            $jumlahMeter = $pemakaian->meter_akhir - $pemakaian->meter_awal;

            // Tarif listrik per kWh
            $tarifPerKwh = 1352;

            // Hitung jumlah tagihan
            $jumlahTagihan = $jumlahMeter * $tarifPerKwh;

            // Simpan tagihan
            $tagihan = Tagihan::create([
                'pemakaian_id'   => $request->pemakaian_id,
                'jumlah_tagihan' => $jumlahTagihan,
                'status'         => 'belum_lunas'
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Tagihan berhasil dibuat',
                'data' => $tagihan->load('pemakaian')
            ], 201);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Detail tagihan
     */
    public function show($id)
    {
        $tagihan = Tagihan::with('pemakaian')->find($id);

        if (!$tagihan) {
            return response()->json([
                'success' => false,
                'message' => 'Tagihan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $tagihan
        ]);
    }

    /**
     * Update status tagihan
     */
    public function update(Request $request, $id)
    {
        try {

            $tagihan = Tagihan::find($id);

            if (!$tagihan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tagihan tidak ditemukan'
                ], 404);
            }

            // Validasi status
            $request->validate([
                'status' => 'required|in:lunas,belum_lunas'
            ]);

            // Update status
            $tagihan->update([
                'status' => $request->status
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Status tagihan berhasil diupdate',
                'data' => $tagihan
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Hapus tagihan
     */
    public function destroy($id)
    {
        try {

            $tagihan = Tagihan::find($id);

            if (!$tagihan) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tagihan tidak ditemukan'
                ], 404);
            }

            $tagihan->delete();

            return response()->json([
                'success' => true,
                'message' => 'Tagihan berhasil dihapus'
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan pada server',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}