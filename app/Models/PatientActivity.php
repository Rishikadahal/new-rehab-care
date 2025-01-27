<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PatientActivity extends Model
{
    protected $table = 'patients_activites';

    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }
}
