<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabDiscount extends Model
{
    use HasFactory;
    protected $fillable = ['created_at','name','phone_number','code','address','home_sampling','age'];
}
