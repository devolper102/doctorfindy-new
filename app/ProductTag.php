<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductTag extends Model
{
    use HasFactory;
    protected $fillable = [
        'name'
    ];
    /**
     * The products that belong to the product tags.
     */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'tag_products');
    }
}
