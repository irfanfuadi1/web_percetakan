<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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

    public function order(): BelongsTo
    {
        return $this->belongsTo(
            Order::class,
            'invoice_code',
            'invoice_code'
        );
    }
}
