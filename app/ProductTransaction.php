<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTransaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_id',
        'status',
        'total',
        'type'
    ];
    public function order()
    {
        return $this->hasOne('App\ProductOrder','id','order_id'); 
    }
}
