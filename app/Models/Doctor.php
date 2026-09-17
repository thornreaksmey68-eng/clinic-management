<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Doctor extends Model
{
    protected $fillable = [
        'doctor_code',
        'name',
        'specialization',
        'gender',
        'phone',
        'email',
        'qualification',
        'address',
    ];
        // doctor has many appointments
        public function appointments(): HasMany
    {
        return $this->hasMany(Appointment::class);
    }

    // doctor has many prescriptions
        public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class);
    }
}
