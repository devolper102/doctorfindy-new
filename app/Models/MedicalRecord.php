<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class MedicalRecord extends Model
{
    use HasFactory;
     protected $fillable = ['title', 'date', 'time', 'doctor_id', 'patient_id', 'report_file', 'prescription_file', 'doctor_name', 'patient_name'];

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
