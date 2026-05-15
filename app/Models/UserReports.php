<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserReports extends Model
{
    use HasFactory;
     protected $fillable = [
    'report_reason',
        'reporter_id',
        'reported_user_id',
    ];

public function reporter()
{
    return $this->belongsTo(User::class, 'reporter_id');
}

public function reportedUser()
{
    return $this->belongsTo(User::class, 'reported_user_id');
}
}
