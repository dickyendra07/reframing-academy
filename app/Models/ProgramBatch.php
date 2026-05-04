<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ProgramBatch extends Model
{
    protected $fillable = [
        'program_id',
        'batch_number',
        'title',
        'slug',
        'location',
        'venue',
        'start_date',
        'end_date',
        'quota',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function program(): BelongsTo
    {
        return $this->belongsTo(Program::class);
    }

    public function prices(): HasMany
    {
        return $this->hasMany(ProgramPrice::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class, 'program_batch_id');
    }
}