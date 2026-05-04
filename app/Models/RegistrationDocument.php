<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationDocument extends Model
{
    protected $fillable = [
        'registration_id',
        'document_type',
        'file_path',
        'status',
        'admin_note',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}