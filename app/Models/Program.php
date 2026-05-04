<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    protected $fillable = [
        'code',
        'name',
        'slug',
        'description',
        'status',
    ];

    public function batches(): HasMany
    {
        return $this->hasMany(ProgramBatch::class);
    }

    public function registrations(): HasMany
    {
        return $this->hasMany(Registration::class);
    }
}