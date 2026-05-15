<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class OnlineConsultation extends Model
{
    use Cachable;
    protected $fillable = [
        'doctor_id', 'slots','price'
    ];
}
