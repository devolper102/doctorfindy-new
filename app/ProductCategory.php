<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'status',
        'logo',
        'banner',
    ];
    /**
     * The products that belong to the product categories.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_products');
    }
}
