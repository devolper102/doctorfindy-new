<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;
class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'product_brand_id',
        'product_category_id',
        'product_tax_class_id',
        'product_tag_id',
        'status',
        'discount_price',
        'price_type_id',
        'price_start',
        'price_end',
        'sku',
        'quantity',
        'stock_available',
        'thumbnail',
        'additional_images',
        'meta_title',
        'meta_description',
        'meta_key',
        'short_description',
        'return_policy',
    ];
    protected $casts = [
        'additional_images' => 'array',
        'product_category_id' => 'array',
        'product_tag_id' => 'array',
        'attributes' => 'array',
        'values' => 'array'
    ];
    /**
     * The product categories that belong to the product.
     */
    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'category_products');
    }
    /**
     * The product tags that belong to the product.
     */
    public function tags()
    {
        return $this->belongsToMany(ProductTag::class, 'tag_products');
    }
    /**
     * The product Reviews that belong to the product.
     */
    public function reviews()
    {
        return $this->hasMany('App\ProductReview','product_id','id')->selectRaw('avg(rating) as aggregate, product_id')->groupBy('product_id');
    }
    public function review_rating()
    {
        return $this->hasMany('App\ProductReview','product_id','id');
    }
    /**
     * The product attributes that belong to the product.
     */
    public function attributes()
    {
        return $this->belongsToMany(ProductAttribute::class, 'attribute_products');
    }
    /**
     * The product brand that belong to the product.
     */
    public function brand()
    {
        return $this->hasOne('App\ProductBrand','id','product_brand_id');
    }
}
