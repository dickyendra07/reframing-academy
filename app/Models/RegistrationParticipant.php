<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistrationParticipant extends Model
{
    protected $fillable = [
        'registration_id',
        'participant_order',
        'full_name',
        'email',
        'phone',
        'province',
        'city',
        'profession',
        'education',
        'nik_number',
        'str_number',
        'institution',
        'shirt_size',
        'glove_size',
    ];

    protected $casts = [
        'participant_order' => 'integer',
    ];

    public function registration(): BelongsTo
    {
        return $this->belongsTo(Registration::class);
    }
}
