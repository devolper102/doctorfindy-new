<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VaccinationLocation extends Model
{
    public $table = 'vaccination_locations';
     protected $fillable = [
'vaccination_id','city','hospital_id','hospital_address','room','phone_no','start_time','end_time','days'];

	public function vaccinations()
    {
    	return $this->belongsTo('App\Vaccination','vaccination_id','id');
    }
    public function locations()
    {
    	return $this->belongsTo('App\Location','city','id');
    }

     public function users()
    {
    	return $this->belongsTo('App\User','hospital_id','id');
    }

}
