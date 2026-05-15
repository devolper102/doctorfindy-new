<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'reviewer_name',
        'picture',
        'rating',
        'message',
        'status',
        'user_id'
    ];
    public function products()
    {
        return $this->belongsTo('App\Product','product_id');
    }
    public function client()
    {
        return $this->belongsTo('App\User','user_id');
    }
}
