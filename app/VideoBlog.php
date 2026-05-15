<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class VideoBlog extends Model
{
    public $table = 'video_blogs';
     protected $fillable = [
'url','description'];
}
