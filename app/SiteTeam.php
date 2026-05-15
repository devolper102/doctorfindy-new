<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteTeam extends Model
{
   public $table = 'site_teams';
    protected $fillable = ['full_name','slug','designation','description','image'];
}
