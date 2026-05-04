<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'registration_id',
        'payment_gateway',
        'external_reference',
        'amount',
        'status',
        'payment_url',
        'paid_at',
        'expired_at',
        'raw_response',
    ];

    protected $casts = [
        'amount' => 'integer',
        'paid_at' => 'datetime',
        'expired_at' => 'datetime',
        'raw_response' => 'array',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}