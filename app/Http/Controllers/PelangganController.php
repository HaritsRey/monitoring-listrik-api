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
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil"
     *     )
     * )
     */
    public function index()
    {
        return response()->json(Pelanggan::all());
    }

/**
 * @OA\Post(
 *     path="/api/pelanggan",
 *     tags={"Pelanggan"},
 *     summary="Tambah pelanggan",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"nama","alamat","no_meter","no_hp"},
 *             @OA\Property(property="nama", type="string", example="Raihan"),
 *             @OA\Property(property="alamat", type="string", example="Pekanbaru"),
 *             @OA\Property(property="no_meter", type="string", example="123456789"),
 *             @OA\Property(property="no_hp", type="string", example="08123456789")
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
        $pelanggan = Pelanggan::create($request->all());

        return response()->json($pelanggan, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Update pelanggan",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil diupdate"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $pelanggan = Pelanggan::findOrFail($id);

        $pelanggan->update($request->all());

        return response()->json($pelanggan);
    }

    /**
     * @OA\Delete(
     *     path="/api/pelanggan/{id}",
     *     tags={"Pelanggan"},
     *     summary="Hapus pelanggan",
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil dihapus"
     *     )
     * )
     */
    public function destroy($id)
    {
        Pelanggan::destroy($id);

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}