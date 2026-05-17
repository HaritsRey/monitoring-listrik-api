<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\MeterListrikController;
use App\Http\Controllers\PemakaianController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\StatistikController;

Route::apiResource('pelanggan', PelangganController::class);
Route::apiResource('meter-listrik', MeterListrikController::class);
Route::apiResource('pemakaian', PemakaianController::class);
Route::apiResource('tagihan', TagihanController::class);
Route::apiResource('pembayaran', PembayaranController::class);
Route::get(
    'statistik/total-pelanggan',
    [StatistikController::class, 'totalPelanggan']
);

Route::get(
    'statistik/total-tagihan',
    [StatistikController::class, 'totalTagihan']
);

Route::get(
    'statistik/total-pembayaran',
    [StatistikController::class, 'totalPembayaran']
);

Route::get(
    'statistik/total-pemakaian',
    [StatistikController::class, 'totalPemakaian']
);