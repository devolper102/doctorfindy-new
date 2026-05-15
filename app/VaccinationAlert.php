<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaccinationAlert extends Model
{
   
    public $table = 'vaccination_alerts';
     protected $fillable = [
'title','vaccination_id','start_date','end_date','start_time','end_time','alert_parents'];

	public function vaccinations()
    {
    	return $this->belongsTo('App\Vaccination','vaccination_id','id');
    }
    
}
