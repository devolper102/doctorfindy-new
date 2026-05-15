<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Facility extends Model
{
	use Cachable;
     public $table = 'facilities';
     protected $fillable = [
'title','description'];
}
