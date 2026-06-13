<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceIntake extends Model
{
    protected $fillable = [
        'no_nota',
        'nama_pelanggan',
        'no_hp',
        'tipe_perangkat',
        'device_type',
        'tanggal_masuk',
        'processor',
        'gpu',
        'ram',
        'storage',
        'components',
        'service_types',
        'kerusakan_inti',
    ];

    protected $casts = [
        'components' => 'array',
        'service_types' => 'array',
    ];
}
