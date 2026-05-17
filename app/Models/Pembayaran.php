<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayaran';

    protected $fillable = [
        'tagihan_id',
        'tanggal_bayar',
        'total_bayar'
    ];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}