<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewCityScrapping extends Model
{
    use HasFactory;
    public $table = 'new_city_scrapping';
     protected $fillable = [
'url','category','type','uniqueid','disable','city'];
}
