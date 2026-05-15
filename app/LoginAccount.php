<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LoginAccount extends Model
{
      public $table = 'activities';
     protected $fillable = [
'user_name','ip_address'];

}
