<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AffairDetail extends Model
{
      public $table = 'affair_details';
     protected $fillable = [
'affairs_id','title','type','status','url','description','image'];

public function affairs()
    {
    	return $this->belongsTo('App\Affairs','affairs_id','id');
    }
}

