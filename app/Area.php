<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;

class Area extends Model
{
	use Cachable;
    /**
     * Fillable for the database
     *
     * @access protected
     * @var    array $fillable
     */
    protected $fillable = array(
        'title', 'location_id','slug'
    );

    public function areaDoctor()
    {
        return $this->belongsToMany('App\User', 'doctor_areas', 'user_id', 'area_id');
    }
    public function locations()
    {
       return $this->belongsToMany('App\Location', 'id', 'location_id');
    }
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
