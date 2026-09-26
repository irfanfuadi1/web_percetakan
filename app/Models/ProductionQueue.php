<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionQueue extends Model
{
    protected $fillable = [
        'invoice_code',
        'invoice_date',
        'payment_status',
        'customer_name',
        'item',
        'specification',
        'file_path',
        'progress',
        'production_status',
    ];

    protected $casts = [
        'invoice_date' => 'datetime',
        'progress' => 'integer',
    ];
}
