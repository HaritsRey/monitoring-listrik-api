<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\BaseController;

class AuthController extends BaseController
{
    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Register berhasil',
            'data' => [
                'name' => $user->name,
                'email' => $user->email
            ]
        ], 201);

    } // <- ini yang tadi kurang

    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {

            return $this->sendError(
                'Email atau password salah',
                401
            );
        }

        // hapus token lama
        $user->tokens()->delete();

        // buat token baru
        $token = $user->createToken(
            'auth_token',
            ['*'],
            now()->addHours(2)
        )->plainTextToken;

        return $this->sendResponse(
            'Login berhasil',
            [
                'token' => $token,
                'expired_in' => '2 jam'
            ]
        );
    }

    // LOGOUT
public function logout(Request $request)
{
    $token = $request->bearerToken();

    if (!$token) {
        return response()->json([
            'success' => false,
            'message' => 'Token tidak ditemukan'
        ], 401);
    }

    $accessToken = \Laravel\Sanctum\PersonalAccessToken::findToken($token);

    if (!$accessToken) {
        return response()->json([
            'success' => false,
            'message' => 'Token tidak valid'
        ], 401);
    }

    $accessToken->delete();

    return response()->json([
        'success' => true,
        'message' => 'Logout berhasil'
    ], 200);
}
}