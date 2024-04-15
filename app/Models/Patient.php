<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $guarded = [];

    public function patientActivity(): HasMany
    {
        return $this->hasMany(PatientActivity::class);
    }
}
