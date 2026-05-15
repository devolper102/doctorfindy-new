<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class FaqAssign extends Model
{
	use Cachable;
	
    public $table = 'faq_assign';
    protected $fillable = ['faq_id', 'assign_value', 'type'];

    public function faqs() {
        return $this->belongsTo('App\Faq', 'faq_id', 'id');
    }
    public function disease()
     {
        return $this->belongsTo(Disease::class, 'assign_value');
    }
     public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'assign_value');
    }
    public function service()
    {
        return $this->belongsTo(Service::class, 'assign_value');
    }
    public function symptom()
    {
        return $this->belongsTo(Symptom::class, 'assign_value');
    }
     public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'assign_value');
    }
     public function procedure()
    {
        return $this->belongsTo(Procedure::class, 'assign_value');
    }

}
