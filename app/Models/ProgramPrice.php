<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramPrice extends Model
{
    protected $fillable = [
        'program_batch_id',
        'label',
        'amount',
        'description',
        'requires_alumni_number',
        'requires_group_name',
        'requires_profession',
        'status',
    ];

    protected $casts = [
        'amount' => 'integer',
        'requires_alumni_number' => 'boolean',
        'requires_group_name' => 'boolean',
    ];

    public function batch(): BelongsTo
    {
        return $this->belongsTo(ProgramBatch::class, 'program_batch_id');
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'program_price_id');
    }
}