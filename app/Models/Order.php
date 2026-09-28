<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $fillable = [
        'invoice_code',
        'order_date',
        'customer_id',
        'product_id',
        'quantity',
        'unit',
        'price',
        'total',
        'paid',
        'status',
        'specification',
        'file_path',
        'notes',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'quantity' => 'decimal:2',
        'price' => 'decimal:2',
        'total' => 'decimal:2',
        'paid' => 'decimal:2',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}