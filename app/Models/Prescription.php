<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'dignosis',
        'medicine',
        'description',
        ];

    // Define relationships
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
    public function doctor_profile()
    {
        return $this->hasOne('App\User', 'id','doctor_id')->with('profile')->with('specialities');
    }
}
