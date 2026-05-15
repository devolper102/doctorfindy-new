<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;
use App\Location;
use App\User;
/**
 * Class AppointmentDuration
 *
 */
class LabBranch extends Model
{
    use Cachable;
   
   protected $fillable = [
    'name','user_id','location_id'];

    public function location()
    {
        return $this->belongsTo('App\Location');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
