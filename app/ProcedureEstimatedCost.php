<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProcedureEstimatedCost extends Model
{
    //
    protected $guarded = [];

      public function procedures()
    {
        return $this->belongsTo('App\Procedure', 'procedure_id','id');
    }
     public function hospital_data()
    {
        return $this->belongsTo('App\User', 'hospital_id');
    }
    
}
