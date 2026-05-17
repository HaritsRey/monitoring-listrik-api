<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MeterListrik extends Model
{
    protected $table = 'meter_listrik';

    protected $fillable = [
        'pelanggan_id',
        'nomor_meter',
        'daya'
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
}