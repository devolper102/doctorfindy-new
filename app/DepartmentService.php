<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class DepartmentService extends Model
{
	use Cachable;
       public $table = 'department_services';
     protected $fillable = [
'department_id','service','description'];

public function departments()
    {
    	return $this->belongsTo('App\Department','department_id','id');
    }
}
