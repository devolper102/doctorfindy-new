<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'client_number',
        'client_name',
        'total',
        'type',
        'quantity',
        'status',
        'cart',
        'is_received'
    ];
    protected $casts = [
        'cart' => 'array',
    ];
    public function client()
    {
        return $this->hasOne('App\User','id','client_id');
    }
}
