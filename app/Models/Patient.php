<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patient extends Model
{
    protected $fillable = [
        'patient_code',
        'name',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'address',
        'blood_group',
        'emergency_contact',
    ];

    /**
     * Patient has many appointments.
     */
    public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }
    /**
     * Patient has many prescriptions.
     */
    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
}
