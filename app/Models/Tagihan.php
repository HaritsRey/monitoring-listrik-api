<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    protected $table = 'tagihan';

    protected $fillable = [
        'pemakaian_id',
        'jumlah_tagihan',
        'status'
    ];

    public function pemakaian()
    {
        return $this->belongsTo(Pemakaian::class);
    }
    public function pembayaran()
    {
         return $this->hasOne(Pembayaran::class);
    }
}