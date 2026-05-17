<?php

namespace App\Http\Controllers;

use App\Models\MeterListrik;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class MeterListrikController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/meter-listrik",
     *     tags={"Meter Listrik"},
     *     summary="Ambil data meter listrik",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(
            MeterListrik::with('pelanggan')->get()
        );
    }

    /**
     * @OA\Post(
     *     path="/api/meter-listrik",
     *     tags={"Meter Listrik"},
     *     summary="Tambah meter listrik",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"pelanggan_id","nomor_meter","daya"},
     *             @OA\Property(property="pelanggan_id", type="integer", example=1),
     *             @OA\Property(property="nomor_meter", type="string", example="MTR001"),
     *             @OA\Property(property="daya", type="string", example="1300 VA")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Berhasil ditambahkan"
     *     )
     * )
     */
    public function store(Request $request)
    {
        return response()->json(
            MeterListrik::create($request->all()),
            201
        );
    }

    /**
     * @OA\Put(
     *     path="/api/meter-listrik/{id}",
     *     tags={"Meter Listrik"},
     *     summary="Update meter listrik",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil update"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $meter = MeterListrik::findOrFail($id);

        $meter->update($request->all());

        return response()->json($meter);
    }

    /**
     * @OA\Delete(
     *     path="/api/meter-listrik/{id}",
     *     tags={"Meter Listrik"},
     *     summary="Hapus meter listrik",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil hapus"
     *     )
     * )
     */
    public function destroy($id)
    {
        MeterListrik::destroy($id);

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}