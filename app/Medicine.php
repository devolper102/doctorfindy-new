<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
          public $table = 'medicines';
     protected $fillable = [
'name','speciality_id'];

public function specialities()
    {
    	return $this->belongsTo('App\Speciality','speciality_id','id');
    }
}
