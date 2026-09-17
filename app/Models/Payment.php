<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    protected $fillable = [
        'patient_id',
        'appointment_id',
        'payment_code',
        'amount',
        'payment_method',
        'status',
        'payment_date',
        'notes',
    ];


    protected $casts = [
        'amount' => 'decimal:2',
        'payment_date' => 'date',
    ];


    /**
     * Payment belongs to a patient.
     */
    public function patient(): BelongsTo
    {
        return $this->belongsTo(Patient::class);
    }


    /**
     * Payment belongs to an appointment.
     */
    public function appointment(): BelongsTo
    {
        return $this->belongsTo(Appointment::class);
    }
}
