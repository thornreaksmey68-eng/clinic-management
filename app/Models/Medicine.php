<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Medicine extends Model
{
    protected $fillable = [
        'medicine_code',
        'name',
        'category',
        'unit',
        'quantity',
        'price',
        'expiry_date',
        'description',
    ];


    protected $casts = [
        'price' => 'decimal:2',
        'expiry_date' => 'date',
    ];


    /**
     * Medicine has many prescription items.
     */
    public function prescriptionItems(): HasMany
    {
        return $this->hasMany(PrescriptionItem::class);
    }
}
