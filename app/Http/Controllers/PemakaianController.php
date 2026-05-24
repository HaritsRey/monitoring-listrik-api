<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;
use App\Models\Tagihan;
use App\Models\Tarif;
use App\Models\MeterListrik;

class PemakaianController extends Controller
{
    public function index()
    {
        return response()->json(
            Pemakaian::with('pelanggan')->get()
        );
    }

public function store(Request $request)
{
    try {

        $validated = $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'bulan' => 'required|string',
            'tahun' => 'required|numeric',
            'meter_akhir' => 'required|numeric|min:0'
        ]);

        // Ambil pemakaian terakhir
        $lastPemakaian = Pemakaian::where(
            'pelanggan_id',
            $request->pelanggan_id
        )->latest()->first();

        // Meter awal otomatis
        $meterAwal = $lastPemakaian
            ? $lastPemakaian->meter_akhir
            : 0;

        // Validasi meter akhir
        if ($request->meter_akhir < $meterAwal) {

            return response()->json([
                'success' => false,
                'message' => 'Meter akhir tidak boleh lebih kecil dari meter awal'
            ], 400);

        }

        // Hitung total pemakaian
        $totalPemakaian = $request->meter_akhir - $meterAwal;

        // Simpan pemakaian
        $pemakaian = Pemakaian::create([
            'pelanggan_id' => $request->pelanggan_id,
            'bulan' => $request->bulan,
            'tahun' => $request->tahun,
            'meter_awal' => $meterAwal,
            'meter_akhir' => $request->meter_akhir,
            'total_kwh' => $totalPemakaian
        ]);

        // Ambil meter listrik pelanggan
        $meter = MeterListrik::where(
            'pelanggan_id',
            $request->pelanggan_id
        )->first();

        // Validasi meter listrik
        if (!$meter) {

            return response()->json([
                'success' => false,
                'message' => 'Meter listrik pelanggan tidak ditemukan'
            ], 404);

        }

        // Ambil tarif
        $tarif = Tarif::find($meter->tarif_id);

        // Validasi tarif
        if (!$tarif) {

            return response()->json([
                'success' => false,
                'message' => 'Tarif tidak ditemukan'
            ], 404);

        }

        // Hitung tagihan otomatis
        $totalTagihan =
            $totalPemakaian * $tarif->tarif_per_kwh;

        // Simpan tagihan otomatis
        Tagihan::create([
            'pemakaian_id' => $pemakaian->id,
            'jumlah_meter' => $totalPemakaian,
            'total_tagihan' => $totalTagihan,
            'status' => 'belum_lunas'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Pemakaian berhasil ditambahkan',
            'data' => [
                'pelanggan_id' => $request->pelanggan_id,
                'meter_awal' => $meterAwal,
                'meter_akhir' => $request->meter_akhir,
                'total_pemakaian' => $totalPemakaian,
                'total_tagihan' => $totalTagihan,
                'status' => 'belum_lunas'
            ]
        ], 201);

    } catch (\Exception $e) {

        return response()->json([
            'success' => false,
            'message' => 'Terjadi kesalahan pada server',
            'error' => $e->getMessage()
        ], 500);

    }
}
    public function show(string $id)
    {
        return response()->json(
            Pemakaian::with('pelanggan')->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $pemakaian = Pemakaian::findOrFail($id);

        $data = $request->validate([
            'pelanggan_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_akhir' => 'required'
        ]);

        $data['total_kwh'] =
            $data['meter_akhir'] - $data['meter_awal'];

        $pemakaian->update($data);

        return response()->json($pemakaian);
    }

    public function destroy(string $id)
    {
        Pemakaian::destroy($id);

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}