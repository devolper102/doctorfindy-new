<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use GeneaLabs\LaravelModelCaching\Traits\Cachable;


class UserService extends Model
{
    use Cachable;
    public $table = 'user_service';
    protected $fillable = ['user_id','speciality_id','speciality','type'];
}
