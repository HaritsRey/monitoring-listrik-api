<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemakaian extends Model
{
    protected $table = 'pemakaian';

    protected $fillable = [
        'pelanggan_id',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
        'total_kwh'
    ];


    public function pelanggan()
    {
    return $this->belongsTo(Pelanggan::class);
    }
    public function tagihan()
    {
    return $this->hasOne(Tagihan::class);
    }
}