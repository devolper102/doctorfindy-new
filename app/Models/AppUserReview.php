<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppUserReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'category',
        'experience',
        'detail',
        ];
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
