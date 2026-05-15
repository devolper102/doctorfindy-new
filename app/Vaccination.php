<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vaccination extends Model
{
    public $table = 'vaccinations';
     protected $fillable = [
'title','description','url','duration'];

	public function vaccinationAlerts()
    {
        	return $this->hasMany('App\VaccinationAlert','vaccination_id','id');
    }
    public function vaccinationLocations()
    {
        	return $this->hasMany('App\VaccinationLocation','vaccination_id','id');
    }

}
