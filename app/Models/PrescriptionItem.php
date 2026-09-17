<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PrescriptionItem extends Model
{
    protected $fillable = [
        'prescription_id',
        'medicine_id',
        'quantity',
        'dosage',
        'instruction',
    ];


    /**
     * Prescription item belongs to a prescription.
     */
    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class);
    }


    /**
     * Prescription item belongs to a medicine.
     */
    public function medicine(): BelongsTo
    {
        return $this->belongsTo(Medicine::class);
    }
}
