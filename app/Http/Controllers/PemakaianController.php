<?php

namespace App\Http\Controllers;

use App\Models\Pemakaian;
use Illuminate\Http\Request;

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
        $data = $request->validate([
            'pelanggan_id' => 'required',
            'bulan' => 'required',
            'tahun' => 'required',
            'meter_awal' => 'required',
            'meter_akhir' => 'required'
        ]);

        $data['total_kwh'] =
            $data['meter_akhir'] - $data['meter_awal'];

        $pemakaian = Pemakaian::create($data);

        return response()->json($pemakaian);
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