<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookTest extends Model
{
    protected $guarded = [];

       public function lab()
    {
        return $this->belongsTo('App\User')->with('profile');
    }

     public function location()
    {
        return $this->belongsTo('App\Location', 'city', 'id');
    }
}
