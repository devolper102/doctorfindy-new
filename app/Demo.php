<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Demo extends Model
{
     
      public $table = 'demos';
     protected $fillable = [
'name','speciality','pdmc_ncs_select','number','registration_number','phone_number','email','city','role','created_at','updated_at'];

}