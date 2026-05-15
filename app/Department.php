<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Department extends Model
{
   use Cachable;
    public $table = 'departments';
     protected $fillable = [
'title','description'];

public function departmentservice()
    {
    	return $this->hasMany('App\DepartmentService');
    }
}
