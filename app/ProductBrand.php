<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBrand extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'logo',
        'banner',
        'meta_title',
        'meta_description',
        'meta_key',
    ];
}
