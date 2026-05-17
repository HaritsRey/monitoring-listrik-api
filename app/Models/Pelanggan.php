<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'nama',
        'alamat',
        'no_meter',
        'no_hp'
    ];

    public function meterListrik()
    {
        return $this->hasOne(MeterListrik::class);
    }
    public function pemakaian()
    {
        return $this->hasMany(Pemakaian::class);
    }
}