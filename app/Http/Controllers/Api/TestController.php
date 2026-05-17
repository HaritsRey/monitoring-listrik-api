<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

class TestController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/test",
     *     summary="Test API",
     *     tags={"Test"},
     *     @OA\Response(
     *         response=200,
     *         description="Berhasil"
     *     )
     * )
     */
    public function index()
    {
        return response()->json([
            'message' => 'API berhasil'
        ]);
    }
}