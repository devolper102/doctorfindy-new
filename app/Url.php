<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
     public $table = 'urls';
     protected $fillable = [
'title','slug','url','meta_title','meta_description','description'];
}