<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchase extends Model
{
    protected $fillable = [
        'purchase_code',
        'purchase_date',
        'supplier_id',
        'product_id',
        'quantity',
        'unit',
        'price',
        'total',
        'paid',
        'status',
        'notes',
    ];

    protected $casts = [
        'purchase_date' => 'datetime',
        'quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'paid' => 'decimal:2',
    ];

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}