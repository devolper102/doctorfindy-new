<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPageSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'banner_image', 
         'category_banner_image', 
         'brand_heading', 
         'feature_heading', 
         'monthly_offer_heading', 
         'weekly_offer_heading', 
         'favourite_product_text', 
         'favourite_product_image', 
         'call_center_logo', 
         'call_center_heading', 
         'call_center_text', 
         'shop_confidence_logo', 
         'shop_confidence_heading', 
         'shop_confidence_text', 
         'safe_payment_logo', 
         'safe_payment_heading', 
         'safe_payment_text',
         'deliver_all_logo', 
         'deliver_all_heading', 
         'deliver_all_text', 
         'product_seo_title', 
         'product_seo_keyword', 
         'product_seo_description',
    ];
}
