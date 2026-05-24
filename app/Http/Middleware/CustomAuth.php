<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Symfony\Component\HttpFoundation\Response;

class CustomAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        $header = $request->header('Authorization');

        if (!$header) {
            return response()->json([
                'status' => false,
                'message' => 'Token tidak ditemukan'
            ], 401);
        }

        $token = str_replace('Bearer ', '', $header);

        $accessToken = PersonalAccessToken::findToken($token);

        if (!$accessToken) {
            return response()->json([
                'status' => false,
                'message' => 'Token tidak valid'
            ], 401);
        }

        return $next($request);
    }
}