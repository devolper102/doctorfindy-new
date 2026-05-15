<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PharmacyMedicineDetail extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'pharmacy_medicine_details';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'pharmacy_medicine_id',
        'description',
        'ingredients',
        'drug_class',
        'dosage_form',
        'uses',
        'in_case_of_overdose',
        'missed_dose',
        'how_to_use',
        'when_not_to_use',
        'side_effects',
        'precautions_and_warnings',
        'drug_interactions',
        'food_interactions',
        'storage_or_disposal',
        'quick_tips',
    ];

    /**
     * Get the medicine that owns the detail.
     */
    public function medicine()
    {
        return $this->belongsTo(PharmacyMedicine::class, 'pharmacy_medicine_id');
    }
}

