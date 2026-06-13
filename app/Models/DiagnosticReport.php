<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DiagnosticReport extends Model
{
    protected $fillable = [
        'ticket_id',
        'technician_name',
        'customer_name',
        'device_model',
        'specs',
        'test_results',
        'notes',
        'status',
    ];

    protected $casts = [
        'specs' => 'array',
        'test_results' => 'array',
    ];
}
