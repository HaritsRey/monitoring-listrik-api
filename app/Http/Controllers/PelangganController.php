<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class PelangganController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/pelanggan",
     *     tags={"Pelanggan"},
     *     summary="Ambil semua data pelanggan",
     *     security={{"bearerAuth":{}}},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil data pelanggan"
     *     )
     * )
     */
    public function index()
    {
        $pelanggan = Pelanggan::all();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diambil',
            'total' => $pelanggan->count(),
            'data' => $pelanggan
        ], 200);
    }

    /**
     * @OA\Post(
     *     path="/api/pelanggan",
     *     tags={"Pelanggan"},
     *     summary="Tambah pelanggan",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nama","alamat","no_meter","no_hp"},
     *
     *             @OA\Property(
     *                 property="nama",
     *                 type="string",
     *                 example="Raihan"
     *             ),
     *
     *             @OA\Property(
     *                 property="alamat",
     *                 type="string",
     *                 example="Pekanbaru"
     *             ),
     *
     *             @OA\Property(
     *                 property="no_meter",
     *                 type="string",
     *                 example="123456789"
     *             ),
     *
     *             @OA\Property(
     *                 property="no_hp",
     *                 type="string",
     *                 example="08123456789"
     *             )
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Data berhasil ditambahkan"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_meter' => 'required|string|unique:pelanggans,no_meter',
            'no_hp' => 'required|string|max:15'
        ]);

        $pelanggan = Pelanggan::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil ditambahkan',
            'data' => $pelanggan
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/api/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Detail pelanggan",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil mengambil detail pelanggan"
     *     ),
     *
     *     @OA\Response(
     *         response=404,
     *         description="Data tidak ditemukan"
     *     )
     * )
     */
    public function show($id)
{
    $pelanggan = Pelanggan::with([

        'meterListrik' => function ($query) {
            $query->select(
                'pelanggan_id',
                'nomor_meter',
                'daya'
            );
        },

        'pemakaian' => function ($query) {
            $query->select(
                'id',
                'pelanggan_id',
                'bulan',
                'tahun',
                'meter_awal',
                'meter_akhir',
                'total_kwh'
            );
        },

        'pemakaian.tagihan' => function ($query) {
            $query->select(
                'id',
                'pemakaian_id',
                'jumlah_tagihan',
                'status'
            );
        },

        'pemakaian.tagihan.pembayaran' => function ($query) {
            $query->select(
                'tagihan_id',
                'tanggal_bayar',
                'total_bayar'
            );
        }

    ])->find($id);

    if (!$pelanggan) {
        return response()->json([
            'success' => false,
            'message' => 'Pelanggan tidak ditemukan'
        ], 404);
    }

    // Custom response manual
    $response = [
        'nama' => $pelanggan->nama,
        'alamat' => $pelanggan->alamat,
        'no_meter' => $pelanggan->no_meter,
        'no_hp' => $pelanggan->no_hp,

        'meter_listrik' => [
            'nomor_meter' => $pelanggan->meterListrik->nomor_meter ?? null,
            'daya' => $pelanggan->meterListrik->daya ?? null,
        ],

        'pemakaian' => $pelanggan->pemakaian->map(function ($pemakaian) {

            return [
                'bulan' => $pemakaian->bulan,
                'tahun' => $pemakaian->tahun,
                'meter_awal' => $pemakaian->meter_awal,
                'meter_akhir' => $pemakaian->meter_akhir,
                'total_kwh' => $pemakaian->total_kwh,

                'tagihan' => $pemakaian->tagihan ? [

                    'jumlah_tagihan' => $pemakaian->tagihan->jumlah_tagihan,
                    'status' => $pemakaian->tagihan->status,

                    'pembayaran' => $pemakaian->tagihan->pembayaran ? [

                        'tanggal_bayar' => $pemakaian->tagihan->pembayaran->tanggal_bayar,
                        'total_bayar' => $pemakaian->tagihan->pembayaran->total_bayar

                    ] : null

                ] : null
            ];
        })
    ];

    return response()->json([
        'success' => true,
        'data' => $response
    ]);
}
    /**
     * @OA\Put(
     *     path="/api/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Update pelanggan",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil update data pelanggan"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {

            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);

        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'no_meter' => 'required|string|unique:pelanggans,no_meter,' . $id,
            'no_hp' => 'required|string|max:15'
        ]);

        $pelanggan->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil diupdate',
            'data' => $pelanggan
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Hapus pelanggan",
     *     security={{"bearerAuth":{}}},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil menghapus pelanggan"
     *     )
     * )
     */
    public function destroy($id)
    {
        $pelanggan = Pelanggan::find($id);

        if (!$pelanggan) {

            return response()->json([
                'success' => false,
                'message' => 'Data pelanggan tidak ditemukan'
            ], 404);

        }

        $pelanggan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data pelanggan berhasil dihapus'
        ], 200);
    }
}