<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'categories',
        'values',
    ];
    protected $casts = [
        'categories' => 'array',
        'values' => 'array'
    ];
    /**
     * The products that belong to the product attribute.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'attribute_products');
    }
}
