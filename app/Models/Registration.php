<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Registration extends Model
{
    protected $fillable = [
        'registration_number',
        'user_id',
        'program_id',
        'program_batch_id',
        'program_price_id',

        'full_name',
        'email',
        'phone',
        'province',
        'city',
        'institution',

        'profession',
        'education',
        'nik_number',
        'str_number',

        'alumni_number',
        'group_name',
        'shirt_size',
        'glove_size',

        'base_price',
        'discount_amount',
        'total_amount',

        'payment_type',
        'dp_amount',

        'registration_status',
        'payment_status',
        'document_status',

        'terms_accepted_at',
        'data_confirmation_accepted_at',

        'paid_at',
        'confirmed_at',
    ];

    protected $casts = [
        'base_price' => 'integer',
        'discount_amount' => 'integer',
        'total_amount' => 'integer',
        'dp_amount' => 'integer',
        'terms_accepted_at' => 'datetime',
        'data_confirmation_accepted_at' => 'datetime',
        'paid_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function batch(): BelongsTo
    {
        return $this->belongsTo(ProgramBatch::class, 'program_batch_id');
    }

    public function price(): BelongsTo
    {
        return $this->belongsTo(ProgramPrice::class, 'program_price_id');
    }

    public function documents(): HasMany
    {
        return $this->hasMany(RegistrationDocument::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(Certificate::class);
    }
}