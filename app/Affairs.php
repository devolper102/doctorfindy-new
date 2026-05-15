<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Affairs extends Model
{
     
      public $table = 'affairs';
     protected $fillable = [
'title','status','priority'];

 public function affairdetails()
    {
    	return $this->hasMany('App\AffairDetail');
    }
}
