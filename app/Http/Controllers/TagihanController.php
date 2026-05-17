<?php

namespace App\Http\Controllers;

use App\Models\Tagihan;
use App\Models\Pemakaian;
use Illuminate\Http\Request;

class TagihanController extends Controller
{
    public function index()
    {
        return response()->json(
            Tagihan::with('pemakaian.pelanggan')->get()
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'pemakaian_id' => 'required'
        ]);

        $pemakaian = Pemakaian::findOrFail(
            $request->pemakaian_id
        );

        $jumlah_tagihan =
            $pemakaian->total_kwh * 1500;

        $tagihan = Tagihan::create([
            'pemakaian_id' => $request->pemakaian_id,
            'jumlah_tagihan' => $jumlah_tagihan,
            'status' => 'BELUM_LUNAS'
        ]);

        return response()->json($tagihan);
    }

    public function show(string $id)
    {
        return response()->json(
            Tagihan::with('pemakaian.pelanggan')
                ->findOrFail($id)
        );
    }

    public function update(Request $request, string $id)
    {
        $tagihan = Tagihan::findOrFail($id);

        $tagihan->update($request->all());

        return response()->json($tagihan);
    }

    public function destroy(string $id)
    {
        Tagihan::destroy($id);

        return response()->json([
            'message' => 'Tagihan berhasil dihapus'
        ]);
    }
}