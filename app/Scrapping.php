<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scrapping extends Model
{
      public $table = 'scrappings';
     protected $fillable = [
'url','category','type','uniqueid','disable','city'];

}

